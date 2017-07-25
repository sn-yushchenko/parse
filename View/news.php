<?php include(ROOT.'/layout/header.php');?>
<div class="admin">
        <h1>Список новостей блок "Главное"</h1>
        <button id="refresh" type="button" class="btn btn-success btn-sm">Обновить</button>
        <div id="date"></div>
        <div class="text-center table-responsive" id="table-task">
                <table class="table table-bordered table-hover">
                <thead>
                    <tr class="active">
                        <th class="text-center">id</th>
                        <th class="text-center">Дата</th>
                        <th class="text-center">Ссылка</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                   <?php foreach($arr as $key=>$value): ?>
                    <tr>
                        <td class="text-center"><?php echo date("d.m.Y h:i:s",$value['date']); ?></td>
                        <td class="text-center"><a href="<?php echo $value['link']; ?>"><?php echo $value['description']; ?></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include(ROOT.'/layout/footer.php');?>