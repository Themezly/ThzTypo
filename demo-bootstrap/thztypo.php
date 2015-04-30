<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ThzTypo - Advanced typography option picker with font preview</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="choosen/css/choosen.min.css"/>
<link rel="stylesheet" type="text/css" href="../thztypo/css/style.css"/>
<body>
	<div class="thz-typography-group">
		<h1>ThzTypo Bootstrap Demo Preview</h1>
		<h3>Advanced typography option picker with font preview, standard and Google font sets, font size, line height, letter spacing and color picker</h3>
		<p>
			This typography option is using only one reusable preview set. </br>
			Thus reducing your site page load in case you need to include typography option for multiple elements.
		</p>
		<p>
			There are no expensive queries and all scripts are executed only on user interaction.</br>
			This way you can rest assured that there will be no page load overage.
		</p>
	</div>
	<form>
		<!-- .thz-fontbox form-group -->
		<div class="thz-fontbox form-group">
			<div class="thz-typography-group">
				<span>Selected font</span>
				<input type="text" class="thz-font-input form-control" value="Open Sans|regular|latin" readonly />
			</div>
			<div class="thz-typography-group">
				<span>Size</span>
				<input class="thz-font-size form-control" type="number" value="30" step="1" />
			</div>
			<div class="thz-typography-group">
				<span>Lineheight</span>
				<input class="thz-font-lineheight form-control" type="number" value="1.4"  step="0.01" />
			</div>
			<div class="thz-typography-group">
				<span>Letter spacing</span>
				<input class="thz-letter-spacing form-control" type="number" value="0"  step="1" />
			</div>
			<div class="thz-typography-group">
				<span>Color</span>
				<input class="thz-font-color form-control" type="text" value="#ff6600"/>
			</div>
		</div>
		<!-- /.thz-fontbox form-group -->
		
		<!-- .thz-fontbox form-group -->
		<div class="thz-fontbox form-group">
			<div class="thz-typography-group">
				<span>Selected font</span>
				<input type="text" class="thz-font-input form-control" value="Oleo Script|regular|latin" readonly />
			</div>
			<div class="thz-typography-group">
				<span>Size</span>
				<input class="thz-font-size form-control" type="number" value="14" step="1" />
			</div>
			<div class="thz-typography-group">
				<span>Lineheight</span>
				<input class="thz-font-lineheight form-control" type="number" value="1.4"  step="0.01" />
			</div>
			<div class="thz-typography-group">
				<span>Letter spacing</span>
				<input class="thz-letter-spacing form-control" type="number" value="0"  step="1" />
			</div>
			<div class="thz-typography-group">
				<span>Color</span>
				<input class="thz-font-color form-control" type="text" value="#ffffff"/>
			</div>
		</div>
		<!-- /.thz-fontbox form-group -->
		
		<!-- .thz-fontbox form-group -->
		<div class="thz-fontbox form-group">
			<div class="thz-typography-group">
				<span>Selected font</span>
				<input type="text" class="thz-font-input form-control" value="Sintony|700|latin-ext" readonly />
			</div>
			<div class="thz-typography-group">
				<span>Size</span>
				<input class="thz-font-size form-control" type="number" value="40" step="1" />
			</div>
			<div class="thz-typography-group">
				<span>Lineheight</span>
				<input class="thz-font-lineheight form-control" type="number" value="1.4"  step="0.01" />
			</div>
			<div class="thz-typography-group">
				<span>Letter spacing</span>
				<input class="thz-letter-spacing form-control" type="number" value="0"  step="1" />
			</div>
			<div class="thz-typography-group">
				<span>Color</span>
				<input class="thz-font-color form-control" type="text" value="#f286c5"/>
			</div>
		</div>
		<!-- /.thz-fontbox form-group -->
		
		<!-- .thz-fontbox form-group -->
		<div class="thz-fontbox form-group">
			<div class="thz-typography-group">
				<span>Selected font</span>
				<input type="text" class="thz-font-input form-control" value="'Helvetica Neue', Helvetica, Arial, sans-serif|400" readonly />
			</div>
			<div class="thz-typography-group">
				<span>Size</span>
				<input class="thz-font-size form-control" type="number" value="24" step="1" />
			</div>
			<div class="thz-typography-group">
				<span>Lineheight</span>
				<input class="thz-font-lineheight form-control" type="number" value="1.4"  step="0.01" />
			</div>
			<div class="thz-typography-group">
				<span>Letter spacing</span>
				<input class="thz-letter-spacing form-control" type="number" value="0"  step="1" />
			</div>
			<div class="thz-typography-group">
				<span>Color</span>
				<input class="thz-font-color form-control" type="text" value="#86f29c" />
			</div>
		</div>
		<!-- /.thz-fontbox form-group -->
	</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="../thztypo/assets/iris/color.js"></script>
<script src="../thztypo/assets/iris/iris.js"></script>
<script src="../thztypo/js/thztypo.js"></script>
<script src="choosen/js/choosen.min.js"></script>

<script type="text/javascript">
(function($) {
   $(document).ready(function() {

      $('.thz-fontbox').ThzTypo();
	  
	  
	  // bootstrap casses and choosen
	  $('#thz-font-variant,#thz-font-subset').addClass('form-control');
	  
	  $("#thz-font-family").chosen();
	  
      // this is iris, you can use any color picker you like
      $('.thz-font-color').iris({
         hide: true,
         palettes: false,
         change: function(event, ui) {

            $('.thz-fontbox').ThzTypo('ThzChange');
         }

      });

      $(document.body).click(function(e) {
         if (!$(e.target).is('.thz-font-color, .iris-picker, .iris-picker-inner')) {
            $('.thz-font-color').iris('hide');
         }
      });

      $('.thz-font-color').click(function(event) {
         $('.thz-font-color').iris('hide');
         $(this).iris('show');
         return false;
      });

   });
}(jQuery));
</script>
	<?php 
		require '../thztypo/assets/thztypo/thztypo.class.php';
		$ThzTypo =  new ThzTypo;
	?>
</body>
</html>