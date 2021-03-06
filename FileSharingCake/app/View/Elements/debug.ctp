<?php if (Configure::read('debug') >= 2): ?>
    <table class="cake-sql-log" cellspacing="0" border="0">
        <caption>
            Contenue de la Session
        </caption>
        <thead>
            <tr><th>$session->read();</th></tr>
        </thead>
    <tbody>
        <tbody>
            <tr>
                <td><?php debug($this->Session->read()); ?></td>
            </tr>
        </tbody>
    </tbody>
    </table>
    <style type="text/css">
    .cake-sql-log{ width:100%;  background-color:#000;  color:#FFF; border-collapse:collapse;   text-align:left; }
    .cake-sql-log caption{ background-color:#7a6a53;    color:#FFF; padding: 5px 0;}
    .cake-sql-log td{ padding:3px;  border:1px solid #999;  background-color:#EEE;  color:#000; }
    </style>
    <?php echo $this->element('sql_dump'); ?>
    <?php echo $this->element('data'); ?>
<?php endif; ?>