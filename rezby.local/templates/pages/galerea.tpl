<div id="container">
	<div class="thumbs">
		{foreach $galerea as $k=>$v}
			<div class="view fourth-effect">
				<a href="{$v['urlBigImage']}" style="background-image:url({$v['urlSmallImage']})" title="{$v['title']}"></a>
				<div class="mask"></div>
			</div>
		{/foreach}
	</div>
	<!-- JavaScript includes - jQuery, turn.js and our own script.js -->
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="{uri 'js/touchTouch.jquery.js'}"></script>
	<script src="{uri 'js/script.js'}"></script>
</div>