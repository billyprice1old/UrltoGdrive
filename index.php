<body>
        <div>
            <input type="text" placeholder="url" id="url"><br />
            <input type="text" placeholder="title" id="title"><br />
            <input type="text" placeholder="split size in mb" name="split"><br />

            <input type="button" value="copy files" />
            <br/><br/>
            <div class="output"></div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="jquery-1.10.1.min.js"><\/script>')</script>
        <script>
            var progressInterval;
            $('input[type=button]').on('click',function(){
		
		var url = $('#url').val();
                var title = $('#title').val();
                
                $.ajax({
                    url:'copy.php',
                    type: 'post',
                    data: { "url": url, "title": title },
                    dataType:'json',
                    success: function(data) {
                        console.log(data);
                        if(progressInterval) {
                            clearInterval(progressInterval);
                        }
                    },
                    error:function(err){
                        console.log(err);
                        if(progressInterval) {
                            clearInterval(progressInterval);
                        }
                    }
                });

                progressInterval = setInterval(function(){
                    $.ajax({
                        url:'copy-progress.php',
                        type: 'get',
                        data: {"title": title},
                        dataType:'json',
                        success: function(data) {
                            console.log(data);
                            $('.output').text((parseInt(data.progress))+"%");
                        },
                        error:function(err){
                            console.log(err);
                        }
                    });

                }, 100);

            });



        </script>
    </body>

