				<div class="mobile-widgets">
<?php 
	dynamic_sidebar('widgets_mobile'); 
?>
				</div>
				<div id="mobile-copyright">
					<code><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?> - <?php echo __('Empowered by ', 'handcraft-expo'); ?><a href="https://wordpress.org/">WordPress</a></code>
				</div>
			</div>
		</div>
	</div>		
<?php wp_footer(); ?>
	</body>
</html>