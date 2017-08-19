<div class="container">
<div class="row spacer">

    <div class="col-lg-12">
        <h1>srt.fun URL shortener</h1>
    </div>
</div>



    <div class="row">
        <div class="col-lg-2 col-md-0">

        </div>
        <div class="col-lg-8 col-md-12 col-xs-12 main">
            <h2 class="error"><?=$message?></h2><br>
            <h1 class="headline">
                Paste a link to shorten it
            </h1>

            <input type="text" id="link">
            <button class="btn btn-primary go">Shorten!</button>

            <br><br>

            <input class="response hidden"><button class="btn btn-info copy hidden" data-clipboard-target=".response">Copy</button>
            <br><br><br>
            <div class="hidden">
                <p class="little">Analytics Link</p>


            </div>
            <input class="hidden" id="admin"><button class="btn btn-info copy hidden" data-clipboard-target="#admin">Copy</button>

        </div>

        <div class="col-lg-2 col-md-0">

        </div>

    </div>


</div>
<br><br><br><br><br>


<div class="ad"> Was this free service helpful? <br>Why not <a href="http://calebcalebcaleb.com"> hire me </a> for your next web project, or <a href="http://paypal.me/calebcalebcaleb">buy me a beer</a>?
</div>


<script>

    $('body').keydown(function (e){

        if(e.keyCode == 13){
            $('.go').click();
        }
    });


    $('.go').click(function(){
        if($('#link').val().length < 6){
            return false;
        }




        var url = "<?=base_url()?>welcome/ingest";
        var data = {url: $('#link').val()};
        $.post(url, data, function(data){
            console.log(data);
            data = JSON.parse(data);

            $('.hidden').removeClass('hidden');


            $('.copy').removeClass('hidden');


            var cuteSayings = ['Nailed It!','Nice one!','👒Chapeau!👒','Great Job!', 'You Did It!', "Shortened.... but size doesn't matter"];

            var cuteSaying = cuteSayings[Math.floor(Math.random()*cuteSayings.length)];

            $('.headline').html(cuteSaying);

            $('.response').val(data.url);

            $('#admin').val(data.admin_link);

            new Clipboard('.copy');



        })
    });

    $('.copy').click(function(){
        $(this).html('Copied!');
        window.setTimeout(function(){
            $('.copy').html('Copy');
        }, 5000);
    })

</script>

