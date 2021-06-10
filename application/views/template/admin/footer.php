<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/modernizr/css-scrollbars.js"></script>
<!-- classie js -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/classie/classie.js"></script>
<!-- notification js -->


<!-- data tables -->
<script src="<?= base_url('assets/datatables.min.js') ?>"></script>

<script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap-growl.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/script.js"></script>
<script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
<script src="<?= base_url() ?>assets/js/demo-12.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script>
    function addRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        if (rowCount < 11) { // limit the user from creating fields more than your limits
            var row = table.insertRow(rowCount);
            var colCount = table.rows[0].cells.length;
            for (var i = 0; i < colCount; i++) {
                var newcell = row.insertCell(i);
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
            }
        } else {
            alert("Maximu Form per ticket is 10");

        }
    }

    function deleteRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if (null != chkbox && true == chkbox.checked) {
                if (rowCount <= 1) { // limit the user from removing all the fields
                    alert("Cannot Remove all the Form.");
                    break;
                }
                table.deleteRow(i);
                rowCount--;
                i--;
            }
        }
    }
</script>



</body>

</html>