<?php
global $Frontend;
/**
 * Template Name: 회사소개
 */
get_header();
?>
<section id="content">
	<?php get_template_part('theme-parts/post', 'share'); ?>
	<div class="page-container">
		<div id="page-<?php the_ID(); ?>" <?php post_class('page-company'); ?>>
			<div class="header">
				<h1>회사 소개</h1>
			</div>
			<div class="section-intro">
				<div class="company-intro-item">
					<h2>Mission</h2>
					<h3>선으로 하나 되는 세상</h3>
					<p>LS전선은 전력과 통신 기술로 전 세계인을 하나로 이어주고 세상을 풍요롭고 편리하게 만들고 있습니다. 시공간의 제약없이 에너지와 정보를 이용할 수 있는 ‘선으로 하나 되는 세상’을 만들어 인류 삶의 질을 향상시키고 더 밝은 미래를 창조하겠습니다.</p>
				</div>
				<div class="company-intro-item">
					<h2>Vision 2030</h2>
					<h3>케이블 솔루션 글로벌 리더</h3>
					<p>LS전선은 2020년 ‘케이블 솔루션 글로벌 리더’를 비전으로 선포하였습니다. 글로벌 사업 운영을 가속화하고, 혁신을 통해 비즈니스 모델을 재창출하며, 자율경영을 바탕으로 한 임직원의 동기부여와 경쟁력 있는 사업 운영 체계 수립을 4대 전략방향으로 삼았습니다. LS전선은 이 네 가지 전략을 성공적으로 추진함으로써 새로운 케이블 솔루션 가치를 모든 고객이 누릴 수 있도록 역량을 집중하고, 나아가 미래 비전 실현을 앞당길 수 있도록 노력하고 있습니다.</p>
				</div>
				<div class="company-intro-item">
					<h2>글로벌 네트워크</h2>
					<p>LS전선은 설립 이후, 글로벌 기업으로 성장하기 위해 쉼 없이 달려왔습니다. 각 지역 특성을 고려한 현지화 전략을 기반으로 선진 시장과 신흥 시장에서 균형 잡힌 성장을 이뤄가기 위하여 권역별 지역본부체제를 운영하고 있으며, 전 세계 20여 개국에 60여 거점을 보유하고 있습니다.</p>
					<img src="<?php echo THEME_IMAGE_URI ?>/img-company-map.png" alt="글로벌 네트워크 현황">
				</div>
			</div>
			<div class="section-timeline">
				<h2>연혁</h2>

				<div class="timeline-container">
					<div class="timeline-item">
						<div class="year">2022</div>
						<div class="content">
							<p>국내 유일의 해저 전력 케이블<br class="hidden-mobile"> 포설선 ‘GL2030’ 취항</p>
						</div>
					</div>
					<div class="timeline-item">
						<div class="year">2021</div>
						<div class="content">
							<ul>
								<li>전기차용 고전압(800V) 권선 양산</li>
								<li>ESG 경영 선포</li>
							</ul>
						</div>
					</div>
					<div class="timeline-item">
						<div class="year">2019</div>
						<div class="content">
							<ul>
								<li>세계 최초 초전도 케이블 상용화</li>
								<li>500kV 초고압 케이블 국가핵심기술 지정</li>
							</ul>
						</div>
					</div>
					<div class="timeline-item">
						<div class="year">2018</div>
						<div class="content">
							<ul>
								<li>HVDC 케이블 세계 최초 공인인증</li>
							</ul>
						</div>
					</div>
					<div class="timeline-item">
						<div class="year">2017</div>
						<div class="content">
							<ul>
								<li>미국 최초 해상풍력단지에 해저 케이블 공급</li>
							</ul>
						</div>
					</div>
					<div class="timeline-item">
						<div class="year">2003</div>
						<div class="content">
							<ul>
								<li>LG그룹에서 LG전선(현 LS그룹)으로 분리</li>
							</ul>
						</div>
					</div>
					<div class="timeline-item">
						<div class="year">1962</div>
						<div class="content">
							<ul>
								<li>한국케이블공업 설립</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="history-youtube">
					<div class=" youtube-container">
						<iframe src="https://www.youtube.com/embed/whJ9MaiD4wM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			</div>

			<div class="section-finance">
				<h2>재무실적</h2>
				<div class="finance-container">
					<div class="finance-charts">
						<div class="chart-item">
							<h4><span>매출액</span></h4>
							<p>(단위: 백만원)</p>
							<div class="img">
								<img src="<?php echo THEME_IMAGE_URI ?>/img-company-chart-1.png" alt="매출액 차트">
							</div>
						</div>
						<div class="chart-item">
							<h4><span>영업이익</span></h4>
							<p>(단위: 백만원)</p>
							<div class="img">
								<img src="<?php echo THEME_IMAGE_URI ?>/img-company-chart-2.png" alt="영업이익 차트">
							</div>
						</div>
						<div class="chart-item">
							<h4><span>당기순이익</span></h4>
							<p>(단위: 백만원)</p>
							<div class="img">
								<img src="<?php echo THEME_IMAGE_URI ?>/img-company-chart-3.png" alt="당기순이익 차트">
							</div>
						</div>
					</div>
					<div class="finance-table">
						<p>(단위: 백만 원)</p>
						<table>
							<caption>재무실적 표</caption>
							<thead>
								<tr>
									<th>구분</th>
									<th>2019</th>
									<th>2020</th>
									<th>2021</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>매출액</td>
									<td>4,602,796</td>
									<td>4,831,489</td>
									<td>6,111,367</td>
								</tr>
								<tr>
									<td>영업이익</td>
									<td>162,590</td>
									<td>164,905</td>
									<td>230,355</td>
								</tr>
								<tr>
									<td>당기순이익</td>
									<td>86,706</td>
									<td>114,083</td>
									<td>162,590</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="section-business">
				<h2>사업영역</h2>
				<div class="business-item-wrap">
					<div class="business-item">
						<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-business-1.png" alt="송전,해저,배전 케이블&amp;시스템">
						<p>송전&middot;해저&middot;배전<br>케이블&amp;시스템</p>
					</div>
					<div class="business-item">
						<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-business-2.png" alt="통신 케이블 솔루션">
						<p>통신 케이블<br>솔루션</p>
					</div>
					<div class="business-item">
						<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-business-3.png" alt="산업용 케이블&amp;하네스">
						<p>산업용<br>케이블&amp;하네스</p>
					</div>
					<div class="business-item">
						<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-business-4.png" alt="케이블 소재">
						<p>케이블 소재<br>&nbsp;</p>
					</div>
				</div>
			</div>
			<div class="section-power">
				<h2>신성장 동력</h2>
				<div class="power-item">
					<div class="header">
						<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-parts-1.png" alt="신재생 에너지">
						<p>신재생 에너지</p>
					</div>
					<div class="content">
						<div class="content-item">
							<h5>해저케이블</h5>
							<ul>
								<li>초장거리 국가 간 전력망 연계 및 해상풍력발전에 사용</li>
							</ul>
						</div>
						<div class="content-item">
							<h5>울트라캐패시터(UC)</h5>
							<ul>
								<li>고속 충·방전과 긴 수명이 장점인 산업용 특수 배터리</li>
							</ul>
						</div>
						<div class="content-item">
							<h5>HVDC 케이블</h5>
							<ul>
								<li>초장거리 저손실 전력 전송 기능 구현</li>
							</ul>
						</div>
						<div class="content-item">
							<h5>산업용 전선(풍력발전기용)</h5>
							<ul>
								<li>풍향 변화에 대응이 가능한 높은 강도와 유연성 확보</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="power-item">
					<div class="header">
						<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-parts-2.png" alt="전기차 부품">
						<p>전기차 부품</p>
					</div>
					<div class="content">
						<div class="content-item">
							<h5>전기차 모터용 케이블</h5>
							<ul>
								<li>800V 고전압 모터용 권선</li>
								<li>현대, 기아 전기차 단독 공급 중</li>
							</ul>
						</div>
						<div class="content-item">
							<h5>배터리 부품</h5>
							<ul>
								<li>버스바, 모듈, 배터리팩 케이스</li>
								<li>생산 플랫폼화 통한 맞춤형 레이아웃 제공</li>
								<li>일반 강철 케이스 1/2 수준으로 무게 경감</li>
							</ul>
						</div>
						<div class="content-item">
							<h5>고전압하네스</h5>
							<ul>
								<li>자동차 전기신호와 전력을 전달하는 고전압 와이어링 하네스</li>
							</ul>
						</div>
						<div class="content-item">
							<h5>액랭식 충전케이블</h5>
							<ul>
								<li>액체냉각방식을 적용한 400kW 이상급 초급속 충전기용 케이블</li>
							</ul>
						</div>
						<div class="content-item">
							<h5>EV용 케이블</h5>
							<ul>
								<li>구리보다 40% 가벼운 알루미늄 도체 사용</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="section-sustainability">
				<div class="header">
					<h2>지속가능경영</h2>
					<p class="moto">선(線) 그 이상의 가치로 더 나은 미래를 향해 나아가다</p>
					<p>LS전선은 지속가능한 미래를 만드는 전 지구적인 노력에 동참합니다. 우리가 추구하는 가치와 사회가 원화는 가치의 조화를 이루며 글로벌 지역사회에 긍정적 영향력을 확산합니다.</p>
					<div class="esg-vision">
						<div class="title">
							<span>지속가능한 미래를 선도하는<br class="hidden-pc"> No.1 친환경 케이블 솔루션</span>
						</div>
						<div class="vision-item-wrap">
							<div class="vision-item">
								<div>녹색 인프라 혁신을 통한<br class="hidden-mobile"> <strong>기후 변화</strong></div>
							</div>
							<div class="vision-item">
								<div>모두가 행복한<br class="hidden-mobile"> <strong>안전 최우선 사업장</strong><br class="hidden-mobile"> 구현</div>
							</div>
							<div class="vision-item">
								<div>공정하고 투명한<br class="hidden-mobile"> <strong>ESG 경영</strong> 실천</div>
							</div>
						</div>
					</div>
				</div>
				<div class="body">
					<div class="body-item">
						<h3>환경책임</h3>
						<div class="body-item-child">
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-1-1.png" alt="동해사업장 RE50 달성">
								<p>동해사업장<br>RE50 달성</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-1-2.png" alt="환경경영시스템(ISO 14001) 국내 시공 현장 확대">
								<p>환경경영시스템<br class="hidden-pc">(ISO 14001)<br>국내 시공 현장 확대</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-1-3.png" alt="주요 제품 EPD 인증 확보">
								<p>주요 제품<br>EPD 인증 확보</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-1-4.png" alt="수입화학물질 화평법 등록 1,000톤 이상">
								<p>수입화학물질 화평법 등록<br>1,000톤 이상</p>
							</div>
						</div>
					</div>
					<div class="body-item">
						<h3>최우선의 가치, 안전</h3>
						<div class="body-item-child">
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-2-1.png" alt="SCL 인증 확대 국내·외 전 시공분야">
								<p>SCL 인증 확대<br>국내·외 모든 시공분야</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-2-2.png" alt="Safety Moment 주요 전사회의체 시행">
								<p>Safety Moment<br>주요 전사회의체 시행</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-2-3.png" alt="고위험 테마 개선 투자 66억 원(`22년) 149억 원(3개년 누적)">
								<p>고위험 테마 개선 투자<br>66억 원(`22년)<br>149억 원(3개년 누적)</p>
							</div>
						</div>
					</div>
					<div class="body-item">
						<h3>미래 성장동력</h3>
						<div class="body-item-child">
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-3-1.png" alt="연구개발투자 489억 원">
								<p>연구개발투자<br>489억 원</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-3-2.png" alt="특허 확보 127건(누적 920건)">
								<p>특허 확보<br>127건(누적 920건)</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-3-3.png" alt="신제품 매출액 9,846억 원">
								<p>신제품 매출액 9,846억 원</p>
							</div>
						</div>
					</div>
					<div class="body-item">
						<h3>품질 &amp; 제품 책임</h3>
						<div class="body-item-child">
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-4-1.png" alt="품질관리 역량평가제 국내 관계사 5개사 적용">
								<p>품질관리 역량평가제<br>국내 관계사 5개사 적용</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-4-2.png" alt="현장혁신활동 68건 / 17건 (테마활동 / 아이디어 제안)">
								<p>현장혁신활동<br>68건 / 17건<br>(테마활동 / 아이디어 제안)</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-4-3.png" alt="협력사 품질교류회 11회 Level-up 지원 10건">
								<p>협력사 품질교류회 11회<br>Level-up 지원 10건</p>
							</div>
						</div>
					</div>
					<div class="body-item">
						<h3>협력사 동반성장</h3>
						<div class="body-item-child">
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-5-1.png" alt="공동 기술개발">
								<ul>
									<li>LAN 케이블 테스트기기</li>
									<li>자동차센서용 특수 케이블</li>
								</ul>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-5-2.png" alt="2·3차 협력사 동방성장론">
								<p>2·3차 협력사<br>동방성장론</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-5-3.png" alt="협력사 품질교류회 11회 Level-up 지원 10건">
								<p>중국, 베트남, 인도 현지 공급망 구축<br>3,508억 원</p>
							</div>
						</div>
					</div>
					<div class="body-item">
						<h3>지역사회 기여</h3>
						<div class="body-item-child">
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-6-1.png" alt="임직원 참여형 해양정화">
								<p>임직원 참여형<br>해양정화</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-6-2.png" alt="전역장병 동해사업장 취업 연계">
								<p>전역장병 동해사업장<br>취업 연계</p>
							</div>
							<div>
								<img src="<?php echo THEME_IMAGE_URI ?>/icon-company-sustainability-6-3.png" alt="사회공헌 기부">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
