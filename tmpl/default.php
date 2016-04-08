<?php 
// No direct access
defined('_JEXEC') or die;

$urlPrev = JRoute::_('index.php?option=com_reditem&view=itemdetail&id=' . $rows['prev'] . $urloptions);
$urlNext = JRoute::_('index.php?option=com_reditem&view=itemdetail&id=' . $rows['next'] . $urloptions);

?>

<?php if (!empty($rows['prev'])) : ?>
	<div class="prev_reditem">
		<a href="<?php echo $urlPrev; ?>"><?php echo JText::_('JPREVIOUS');?></a>
	</div>
<?php endif; ?>

<?php if (!empty($rows['next'])) : ?>
	<div class="next_reditem">
		<a href="<?php echo $urlNext; ?>"><?php echo JText::_('JNEXT');?></a>
	</div>
<?php endif; ?>

