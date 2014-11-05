<script>
    var url_get_field = "<?php echo URL.'/template/get_field_html'?>";
    var url_get_operator = "<?php echo URL.'/template/get_operator_html'?>";
</script>
<input type="hidden" value="<?php echo isset($category['id'])?$category['id']:''?>" id="category_id">
<input type="hidden" value="<?php echo isset($category['table_name'])?$category['table_name']:''?>" id="table_name">

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Thông tin bộ lọc </h1>

    <div class="col-md-5">
        <form role="form">

            <div class="form-group">
                <label >Tên bộ lọc</label>
                <input type="text" name="filter_name" class="form-control filter_name"  placeholder="Tên bộ lọc">
            </div>

            <!-- bo loc -->
            <div class="condition_group">
                <div class="form-group">
                    <div class="select_field_area">

                    </div>

                    <div class="select_operator_area">

                    </div>

                    <div class="select_compare_area">
                        <input type="text" class="form-control condition_compare col-md-4">
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="form-group" style="margin-top: 10px">
                <a class="add_condition" style="cursor: pointer">Thêm điều kiện</a>
            </div>



            <button type="submit" class="btn btn-default">Lưu lại bộ lọc</button>
        </form>
    </div>
    <div class="col-md-7">
        <!-- hien thi danh sach bo loc da duoc tao -->
    </div>
    <!-- danh sach tim kiem -->
    <div class="col-md-12">

        <table class="table table-striped">
            <tr>
                <td>1,001</td>
                <td>1,003</td>
                <td>1,003</td>
                <td>Lorem</td>
                <td>ipsum</td>
                <td>dolor</td>
                <td>sit</td>
            </tr>
            <tr>
                <td>1,002</td>
                <td>1,003</td>
                <td>1,003</td>
                <td>amet</td>
                <td>consectetur</td>
                <td>adipiscing</td>
                <td>elit</td>
            </tr>
            <tr>
                <td>1,003</td>
                <td>1,003</td>
                <td>1,003</td>

                <td>Integer</td>
                <td>nec</td>
                <td>odio</td>
                <td>Praesent</td>
            </tr>

        </table>
    </div>

</div>