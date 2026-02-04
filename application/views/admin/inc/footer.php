</div>
<script type="text/javascript" src="<?= base_url("assets/js/plugin.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/js/main.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/js/ui-enhancements.js") ?>"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery(".flexslider-wrap .flexslider").flexslider({
			animation: "fade",
			animationLoop: true,
			animationSpeed: 1500,
			slideshow: true,
			pauseOnHover: false,
			controlNav: false,
			directionNav: true,
			start: function(slider){
				// reveal captions on first slide
				if (typeof window.revealActiveCaptions === 'function') window.revealActiveCaptions(slider.container);
			},
			after: function(slider){
				if (typeof window.revealActiveCaptions === 'function') window.revealActiveCaptions(slider.container);
			}
		});

	});

	function loadname(img, previewName) {

		var isIE = (navigator.appName == "Microsoft Internet Explorer");
		var path = img.value;
		var ext = path.substring(path.lastIndexOf('.') + 1).toLowerCase();

		if (ext == "gif" || ext == "jpeg" || ext == "jpg" || ext == "png") {
			if (isIE) {
				$('#' + previewName).attr('src', path);
			} else {
				if (img.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#' + previewName).attr('src', e.target.result);
					}
					reader.readAsDataURL(img.files[0]);
				}
			}

		} else {
			//incorrect file type
		}
	}
</script>
</body>

</html>