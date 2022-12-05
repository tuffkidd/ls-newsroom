<?php

/**
 * Template Name: 다운로드 페이지
 *
 * @package ChannelLS
 * @subpackage Newsroom
 */
function singleDownload($thumb_id, $thumb_size)
{
	// $filepath = $this->get_img_path($thumb_id, $thumb_size);

	$image = wp_get_attachment_image_src($thumb_id, $thumb_size);
	$url = $image[0];

	if (!$image) {
		$url = wp_get_attachment_url($thumb_id);
	}

	$upload_dir = wp_upload_dir();
	$base_dir = $upload_dir['basedir'];
	$base_url = $upload_dir['baseurl'];
	$filepath = str_replace($base_url, $base_dir, $url);
	$filename = basename($filepath);
	$path_parts = pathinfo($filepath);
	$extension = $path_parts['extension'];

	if (!\Normalizer::isNormalized($filename)) {
		$filename = \Normalizer::normalize($filename);
	}

	switch ($extension) {
		case "png":
			$mime = "image/png";
			break;
		case "gif":
			$mime = "image/gif";
			break;
		case "tiff":
			$mime = "image/tiff";
			break;
		case "jpeg":
		case "jpg":
			$mime = "image/jpg";
			break;
			// case "mp4":
			// 	$mime="video/mp4";
			// 	break;
		default:
			$mime = "application/octet-stream";
	}

	// Clean output buffer
	if (ob_get_level() !== 0 && @ob_end_clean() === FALSE) {
		@ob_clean();
		@flush();
	}

	header('Content-Type: ' . $mime);
	header('Content-Disposition: attachment; filename="' . $filename . '"');
	header('Expires: 0');
	header('Content-Transfer-Encoding: binary');
	// header('Content-Length: '.filesize($filepath));
	header('Cache-Control: private, no-transform, no-store, must-revalidate');

	readfile($filepath);
	exit;
}

function selectedDownload($medias)
{
	if ($medias) {
		foreach ($medias as $key => $media) {
			$images[] = wp_get_attachment_url($media);
			$orig = wp_get_original_image_path($media);
			if ($orig) {
				$images[] = $orig;
				// $images[] = wp_get_attachment_image_src($media, 'thumb-720')[0];
				// $images[] = wp_get_attachment_image_src($media, 'thumb-1024')[0];
			}
		}
	}

	if ($images) {
		$zip = new ZipArchive();
		$upload_dir = wp_upload_dir();
		$base_dir = $upload_dir['basedir'];
		$base_url = $upload_dir['baseurl'];

		$zipname = 'LS_mediaLibrary_download_' . current_time('YmdHi') . '.zip';
		$zippath = $upload_dir['basedir'] . '/' . $zipname;

		$zip->open($zippath, ZipArchive::CREATE);

		foreach ($images as $image) {
			$image = str_replace($base_dir, $base_url, $image);
			$download_file = file_get_contents($image, FILE_USE_INCLUDE_PATH);
			$zip->addFromString(basename($image), $download_file);
		}

		$zip->close();

		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename=' . $zipname);
		header('Content-Length: ' . filesize($zippath));
		readfile($zippath);
		unlink($zippath);
	}
}

if ($_POST['type'] == 'all') {
	selectedDownload($_POST['medias']);
	// } else if ($_GET['type'] == 'video') {
	// 	$src = $_GET['video_src'];
	// 	header('Content-Type: application/octet-stream');
	// 	header('Content-Transfer-Encoding: Binary');
	// 	header('Content-disposition: attachment; filename="video.mp4"');
	// 	readfile($src);
} else {
	$thumb_id = $_GET['attach_id'];
	$thumb_size = $_GET['size'];

	singleDownload($thumb_id, $thumb_size);
}
