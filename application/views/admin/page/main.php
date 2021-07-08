<style>
	* {
		box-sizing: border-box
	}

	/* Slideshow container */
	.slideshow-container {
		max-width: 1000px;
		position: relative;
		margin: auto;
	}

	/* Hide the images by default */
	.mySlides {
		display: none;
	}

	/* Next & previous buttons */
	.prev,
	.next {
		cursor: pointer;
		position: absolute;
		top: 50%;
		width: auto;
		margin-top: -22px;
		padding: 16px;
		color: white;
		font-weight: bold;
		font-size: 18px;
		transition: 0.6s ease;
		border-radius: 0 3px 3px 0;
		user-select: none;
	}

	/* Position the "next button" to the right */
	.next {
		right: 0;
		border-radius: 3px 0 0 3px;
	}

	/* On hover, add a black background color with a little bit see-through */
	.prev:hover,
	.next:hover {
		background-color: rgba(0, 0, 0, 0.8);
	}

	/* Caption text */
	.text {
		color: #f2f2f2;
		font-size: 15px;
		padding: 8px 12px;
		position: absolute;
		bottom: 8px;
		width: 100%;
		text-align: center;
	}

	/* Number text (1/3 etc) */
	.numbertext {
		color: #f2f2f2;
		font-size: 12px;
		padding: 8px 12px;
		position: absolute;
		top: 0;
	}

	/* The dots/bullets/indicators */
	.dot {
		cursor: pointer;
		height: 15px;
		width: 15px;
		margin: 0 2px;
		background-color: #bbb;
		border-radius: 50%;
		display: inline-block;
		transition: background-color 0.6s ease;
	}

	.active,
	.dot:hover {
		background-color: #717171;
	}

	/* Fading animation */
	.fade {
		-webkit-animation-name: fade;
		-webkit-animation-duration: 1.5s;
		animation-name: fade;
		animation-duration: 1.5s;
	}

	@-webkit-keyframes fade {
		from {
			opacity: .4
		}

		to {
			opacity: 1
		}
	}

	@keyframes fade {
		from {
			opacity: .4
		}

		to {
			opacity: 1
		}
	}

	.fill {
		display: flex;
		justify-content: center;
		align-items: center;
		overflow: hidden
	}

	.fill img {
		width: 200px;
		height: 300px;
		object-fit: cover;
	}
</style>
<div class="page">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12">
				<h5>Main Dashboard</h5>
				<hr>
			</div>
		</div>
		<form id="form">
			<div class="row">
				<div class="col-12 col-md-12">
					<!-- Slideshow container -->
					<div class="slideshow-container">

						<!-- Full-width images with number and caption text -->
						<div class="mySlides fade">
							<div class="numbertext fill">1 / 3</div>
							<img src="<?php echo base_url('assets/img/home/') ?>sl1.jpeg" style="
							width: 1000px;
							height: 300px;
							object-fit: cover;
							background-position: center;
							">
							<div class="text"></div>
						</div>

						<div class="mySlides fade">
							<div class="numbertext fill">2 / 3</div>
							<img src="<?php echo base_url('assets/img/home/') ?>sl2.jpeg" style="
							width: 1000px;
							height: 300px;
							object-fit: cover;
							background-position: center;
							">
							<div class="text"></div>
						</div>

						<div class="mySlides fade">
							<div class="numbertext fill">3 / 3</div>
							<img src="<?php echo base_url('assets/img/home/') ?>sl3.jpeg" style="
							width: 1000px;
							height: 300px;
							object-fit: cover;
							background-position: center;
							">
							<div class="text"></div>
						</div>

						<!-- Next and previous buttons -->
						<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						<a class="next" onclick="plusSlides(1)">&#10095;</a>
					</div>
					<br>

					<!-- The dots/circles -->
					<div style="text-align:center">
						<span class="dot" onclick="currentSlide(1)"></span>
						<span class="dot" onclick="currentSlide(2)"></span>
						<span class="dot" onclick="currentSlide(3)"></span>
					</div>
				</div>
		</form>
	</div>
</div>


<script type="text/javascript">
	$('#form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			url: '<?php echo base_url('admin/prosestambahPegawai') ?>',
			type: 'POST',
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			error: function(data) {
				Swal.fire('Kesalahan!!', 'Gagal menghubungkan ke server !!', 'error')
			},
			success: function(data) {
				if (data == 1) {
					Swal.fire('Berhasil !!', 'Pegawai berhasil ditambahkan !!', 'success')
					var delay = 1500;
					setTimeout(function() {
						$('#loading').show();
						$('#contentPage').addClass('lodtime');
						$('#contentPage').load('<?php echo base_url('admin/daftarPegawai') ?>', function() {
							$('#loading').hide();
							$('#contentPage').removeClass('lodtime');
						})
					}, delay);
				} else
					Swal.fire('Kesalahan!!', 'Gagal upload !!', 'error')
			}
		})
	});

	$('#return').click(function(event) {
		event.preventDefault();
		$('#loading').show();
		$('#contentPage').addClass('lodtime');
		$('#contentPage').load('<?php echo base_url('admin/kelolaPegawai') ?>', function() {
			$('#loading').hide();
			$('#contentPage').removeClass('lodtime');
		});
	});


	// Next/previous controls
	function plusSlides(n) {
		showSlides(slideIndex += n);
	}

	// Thumbnail image controls
	function currentSlide(n) {
		showSlides(slideIndex = n);
	}

	var slideIndex = 0;
	showSlides();

	function showSlides() {
		var i;
		var slides = document.getElementsByClassName("mySlides");
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		slideIndex++;
		if (slideIndex > slides.length) {
			slideIndex = 1
		}
		slides[slideIndex - 1].style.display = "block";
		setTimeout(showSlides, 2000); // Change image every 2 seconds
	}