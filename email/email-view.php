<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<h2>Your Have <?php echo count($this->pending_posts) ?> pending draft to be published on
    <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h2>
<table style="font-family: Verdana,sans-serif; font-size: 11px; color: #374953; width: 600px;">
    <tr>
        <td align="left"><h4>Post</h4></td>
        <td align="left"><h4>Last Modified</h4></td>
    </tr>
    <?php foreach ($this->pending_posts as $pending_post) {
        ?>
        <tr>
            <td><a href="<?php echo $pending_post['edit_link']; ?>"><?php echo $pending_post['title']; ?></a></td>
            <td><?php echo $pending_post['date']; ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>