<?php
global $Frontend;
/**
 * Template Name: 지속가능경영
 */
get_header();
?>
<section id="content">
	<div class="container">
		<div id="page-<?php the_ID(); ?>" <?php post_class('page-sustainability'); ?>>
			<div class="header">
				<h1>LS전선 지속가능경영 보고서</h1>
				<p>LS전선은 경제, 사회, 환경 부문에 걸쳐 사회적 가치 창출 활동의 성과와 계획을 이해관계자에게 투명하게 공개하기 위해 2010년부터 매년 지속가능경영보고서를 발간하고 있습니다.</p>
			</div>
			<div class="body">
				<h2>2021-2022 지속가능경영 보고서</h2>
				<div class="report-top">
					<div class="img">
						<img src="<?php echo THEME_IMAGE_URI ?>/sustainability/report-top.png" alt="2022년도 지속가능경영보고서 표지">
					</div>
					<div class="meta">
						<p class="desc">환경(Environment), 사회(Social), 지배구조(Governance)에 적극 대응하기 위해 LS전선의 ESG 전략체계를 반영하였습니다.</p>
						<div class="actions">
							<a href="https://www.lscns.co.kr/upload/download/LS_2021_reports_korean.pdf" target="_blank" class="btn-download invert">국문 보고서 다운로드</a>
							<a href="https://www.lscns.co.kr/upload/download/LS_2021_reports_english.pdf" target="_blank" class="btn-download">영문 보고서 다운로드</a>
						</div>
					</div>
				</div>
				<div class="report-past">
					<?php for ($i = 2020; $i >= 2010; $i--) : ?>
						<div class="report-item">
							<?php if ($i > 2015) : ?>
								<div class="year"><?php echo $i ?>-<?php echo $i + 1  ?></div>
							<?php else : ?>
								<div class="year"><?php echo $i ?></div>
							<?php endif; ?>
							<div class="img">
								<img src="<?php echo THEME_IMAGE_URI ?>/sustainability/report-<?php echo $i ?>.png" alt="<?php echo $i; ?>년도 지속가능경영보고서 표지">
							</div>
							<div class="actions">
								<a href="https://www.lscns.co.kr/upload/download/LS_<?php echo $i ?>_reports_korean.pdf" class="btn-download">국문 보고서 다운로드</a>
								<a href="https://www.lscns.co.kr/upload/download/LS_<?php echo $i ?>_reports_english.pdf" class="btn-download">영문 보고서 다운로드</a>
							</div>
						</div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
