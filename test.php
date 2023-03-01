<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js' type='text/javascript'></script>

<script>
    $(document).ready(function(){
//                      $("tr").css("background-color", "#DDDDDD")
                      })
</script>


<?php
include("class.php");
include("connectMySQL.php");

$sql = "SELECT * FROM account_info";
$result = $db->query($sql);
$data_nums = mysqli_num_rows($result); //統計總比數
$per = 5; //每頁顯示項目數量
$pages = ceil($data_nums/$per); //取得不小於值的下一個整數

if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
  $page=1; //則在此設定起始頁數
} else {
  $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}

$start = ($page-1)*$per; //每一頁開始的資料序號
$result = $db->query($sql . ' LIMIT ' . $start . ', ' . $per) or die("Error");
?>

<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
<table class="table table-hover">
<thead>
    <tr>
        <th>帳號</th>
        <th>姓名</th>
        <th>性別</th>
        <th>生日</th>
        <th>信箱</th>
        <th>備註</th>
        <th></th>
    </tr>
</thead>
<tbody>
<?php if(mysqli_num_rows($result) > 0){
    foreach($result as $row){ 
?>
        <tr>
            <td><?php echo $row["account"] ?></td>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["gender"] ?></td>
            <td><?php echo $row["birthday"] ?></td>
            <td><?php echo $row["mail"] ?></td>
            <td><?php echo $row["note"] ?></td>
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifyData">編輯</button>
                <div class="modal fade" id="modifyData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">編輯人員資料</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="accountInput" class="col-sm-2 col-form-label">帳號</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="accountInput" placeholder="請輸入帳號">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nameInput" class="col-sm-2 col-form-label">姓名</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="nameInput" placeholder="請輸入姓名">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="selectGender" class="col-sm-2 col-form-label">性別</label>
                                    <div class="col-sm-10">
                                    <select class="form-control" id="selectGender">
                                        <option>男</option>
                                        <option>女</option>
                                    </select>
                                    </div>
                            </div>
                            <div class="form-group row date">
                            <label for="datepicker_modify" class="col-sm-2 col-form-label">生日</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="datepicker_modify" readonly>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                         $('#datepicker_modify').datepicker({
                                               "format": "mm-dd-yyyy",
                                               "keyboardNavigation": false,
                                               "autoclose": true,
                                               "forceParse": true
                                         });
                                    });
                                </script>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="mailInput" class="col-sm-2 col-form-label">信箱</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="mailInput" placeholder="name@example.com">
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="noteText" class="col-sm-2 col-form-label">備註</label>
                                <div class="col-sm-10">
                                <textarea class="form-control" id="noteText" rows="3"></textarea>
                                </div>
                            </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">離開</button>
                        <button type="button" class="btn btn-primary">編輯</button>
                      </div>
                    </div>
                  </div>
                </div>
                <form method="post" action="deleteData.php">
                <input type="hidden" name="deleteAccount" value="<?php echo $row['account']?>">
                <button type="button" class="btn btn-danger" name="<?php echo $row['account']?>" data-toggle="modal" data-target="#deleteData">刪除</button>
                  <div class="modal fade" id="deleteData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">刪除人員資料</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <?php echo "確認刪除".$row['account']."?";?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger">刪除</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            </td>
        </tr>
  <?php
    }
}
?>
</tbody>
</table>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newData">
    新增人員
</button>

<!-- Modal -->
<form role="form" method="post" action="addData.php">
<div class="modal fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">新增人員資料</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
            <div class="form-group row">
                <label for="accountInput" class="col-sm-2 col-form-label">帳號</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="accountInput" id="accountInput" placeholder="請輸入帳號" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="nameInput" class="col-sm-2 col-form-label">姓名</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="nameInput" id="nameInput" placeholder="請輸入姓名" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="selectGender" class="col-sm-2 col-form-label">性別</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="selectGender" id="selectGender" required="required">
                        <option>男</option>
                        <option>女</option>
                    </select>
                    </div>
            </div>
            <div class="form-group row date">
                <label for="datepicker_add" class="col-sm-2 col-form-label">生日</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="datepicker_add" id="datepicker_add" required="required" readonly >
                <script type="text/javascript">
                    $(document).ready(function(){
                         $('#datepicker_add').datepicker({
                               "format": "yyyy-mm-dd",
                               "keyboardNavigation": false,
                               "autoclose": true,
                               "forceParse": true
                         });
                    });
                </script>
                </div>
            </div>
            <div class="form-group row">
            <label for="mailInput" class="col-sm-2 col-form-label">信箱</label>
                <div class="col-sm-10">
                <input type="email" class="form-control" name="mailInput" id="mailInput" placeholder="name@example.com" required="required">
                </div>
            </div>
            <div class="form-group row">
            <label for="noteText" class="col-sm-2 col-form-label">備註</label>
                <div class="col-sm-10">
                <input type="textarea" class="form-control" name="noteText" id="noteText" rows="3">
                </div>
            </div>
        
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">離開</button>
            <button type="submit" class="btn btn-primary">新增</button>
          </div>
    </div>
  </div>
</div>
</form>
<?php
    //分頁頁碼
    echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
?>
