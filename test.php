<!--
    <head>
        <script src="jquery-3.2.1.min.js"></script>
        <script>
        function makeDB(str, row) {
            if (str.length == 0) { 
                return;
            } 
            else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("POST", "makeNewTable.php?tableName=" + str +"&tableValue="+row, true);
                xmlhttp.send();
            }
        }
        </script>
        <script>
        function addToDatabase(db, value) {
             /*var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "addToTable.php?tableName=" + db +"&tableValue=" + value, true);
                xmlhttp.send();*/
            $.ajax({
                data: 'tableName=' + db + "&tableValue=" + value,
                url: 'addToTable.php',
                method: 'POST', // or GET
                success: function(msg) {
                    alert(msg);
                }
            });
        }
        </script>
        <script>
            function getDatabaseValue(db, id) {
                $.ajax({
                    data: 'tableName=' + db + "&id=" + id,
                    url: 'getTableValue.php',
                    method: 'POST', // or GET
                    success: function(msg) {document.getElementById('real').innerHTML = msg;}
                });
            }
        </script>
        
    </head>
    <body onload = "getDatabaseValue('articles', '27');">
        <form>
        DB name: <input type="text" id="name">
        </form>
        <form> 
        Content name: <input type="text" id="row">
        </form>
        <p><span id="txtHint"></span></p>
        <button onclick="makeDB(document.getElementById('name').value, document.getElementById('row').value)">Make DB</button>
        
        <form>
        DB name: <input type="text" id="dbid">
        </form>
        <form>
            <textarea id="value" name="message" rows="10" cols="30">The cat was playing in the garden.</textarea>
            <br>
        </form>
        <p><span id="txtHint"></span></p>
        <button onclick="addToDatabase(document.getElementById('dbid').value, document.getElementById('value').value)">Add To DB</button>
        <br>
        <button onclick="getDatabaseValue('articles', '27')">Fill</button>
        <p id="real"></p>
    </body>
</html>*/--!>