const currentPage = document.body.dataset.page

function get_article_image_thumb (filename, size) {
	// console.log(filename);
	return (
		filename.substring(0, filename.lastIndexOf('.')) +
		'-' +
		size +
		filename.substring(filename.lastIndexOf('.'))
	)
}
function byteToMegabyte (bytes, decimals) {
	if (bytes == 0) return '0'
	var mb = (bytes / (1024 * 1024)).toFixed(2)
	return mb
}
function formatBytes (bytes, decimals) {
	if (bytes == 0) return '0 Byte'
	var k = 1000 // or 1024 for binary
	var dm = decimals + 1 || 3
	var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
	var i = Math.floor(Math.log(bytes) / Math.log(k))
	return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i]
}

export default {
	currentPage,
	get_article_image_thumb,
	formatBytes,
	byteToMegabyte
}
