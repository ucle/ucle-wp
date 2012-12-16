<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 */
?>

  </div>

  <footer id="footer">
    <?php $d = get_template_directory_uri(); ?>
    <a class="icon facebook" href="https://www.facebook.com/uclentrepreneur"><img src="<?php echo $d; ?>/icons/facebook.png" alt="Facebook" /></a>
    <a class="icon linkedin" href="http://www.linkedin.com/groups?gid=4699230"><img src="<?php echo $d; ?>/icons/linkedin.png" alt="LinkedIn" /></a>
    <a class="icon twitter " href="https://twitter.com/uclentrepreneur"><img src="<?php echo $d; ?>/icons/twitter.png" alt="Twitter" /></a>
    <p>UCL Entrepreneurs Society &copy; 2012-<?php echo date('Y'); ?></p>
  </footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
