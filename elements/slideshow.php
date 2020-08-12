<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>

	<div class="carousel-inner">
		<div class="item active">
				<picture>
				<source srcset="pic/slide1-small.jpg" media="(max-width: 600px)">
				<source srcset="pic/slide1-medium.jpg" media="(max-width: 1100px)">
				<source srcset="pic/slide1.jpg">
				<img src="img/slide1.jpg" class="scaler" alt="Slide">
				</picture>
		</div>

		<div class="item">
							<picture>
				<source srcset="pic/slide2-small.jpg" media="(max-width: 600px)">
				<source srcset="pic/slide2-medium.jpg" media="(max-width: 1100px)">
				<source srcset="pic/slide2.jpg">
				<img src="img/slide2.jpg" class="scaler" alt="Slide">
				</picture>
		</div>

		<div class="item">
							<picture>
				<source srcset="pic/slide3-small.jpg" media="(max-width: 600px)">
				<source srcset="pic/slide3-medium.jpg" media="(max-width: 1100px)">
				<source srcset="pic/slide3.jpg">
				<img src="img/slide3.jpg" class="scaler" alt="Slide">
				</picture>
		</div>
	</div>

	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span> <span
		class="sr-only">Previous</span>
	</a> <a class="right carousel-control" href="#myCarousel"
		data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span>
		<span class="sr-only">Next</span>
	</a>
</div>