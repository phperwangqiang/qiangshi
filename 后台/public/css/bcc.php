<meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>

    <script src="https://sx.xunshengkeji.com/css/ip33.js"></script>
    
    <script type="text/javascript">
        $(function () {


                var data ="<?php echo $_GET['data']; ?>";
                var v = $("[name=dataRadio]:checked").val();
                if (v == "ascii") {
                    data = asciiToHex(data);
                } else {
                    data = formatHex(data);
                    $("#data").val(data);
                }

                if (data == "") {
                    $("#tip1").html("请输入需要校验的数据");
                    $("#tip1").addClass("text-danger");
                    return;
                }

                var reg = /^([0-9a-fA-F]{1,2}\s)*([0-9a-fA-F]{1,2})?$/g;
                var b = reg.test(data);
                if (!b) {
                    $('#txtHex').val('');
                    $('#txtDec').val('');
                    $('#txtOct').val('');
                    $('#txtBin').val('');
                    $("#tip1").html("数据格式不正确");
                    $("#tip1").addClass("text-danger");
                    return;
                }

                var count = 0;
                var sum = 0;
                var ss = data.split(" ");
                for (var i = 0; i < ss.length; i++) {
                    if (ss[i] == "") {
                        continue;
                    }
                    sum = sum ^ parseInt(ss[i], 16);
                    count++;
                }

                var dec = sum;
                var oct = dec.toString(8);

                var hex = dec.toString(16);
                hex = hex.toUpperCase();
                hex = hex.padLeft('0', 2);

                var bin = dec.toString(2);
                bin = bin.padLeft('0', 8);
                bin = bin.substr(0, 4) + " " + bin.substr(4, 4);

               document.write(hex);
           
        });
    </script>
