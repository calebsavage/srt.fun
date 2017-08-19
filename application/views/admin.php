
<div class="container">
    <div class="row spacer">

        <div class="col-lg-12">

        </div>
    </div>



    <div class="row">
        <div class="col-lg-2 col-md-0">

        </div>
        <div class="col-lg-8 col-md-12 col-xs-12 main">
            <h2><?=sizeof($hits)?> hits! (<?=$distinct?> unique visitors) </h2>


            <table id="hits" class="display" cellspacing="0" width="100%">
                <thead>

                    <th>IP Address</th>
                    <th>Referrer</th>
                    <th>Region</th>

                </thead>

                <tbody>
                <?php foreach($hits as $hit):?>
                    <tr>
                        <td>
                            <?=$hit->ip?>
                        </td>


                        <td>
                            <?=$hit->referrer?>
                        </td>

                        <td>
                            <?=$hit->region?>
                        </td>


                    </tr>


                <?php endforeach;?>


                </tbody>


            </table>




        </div>

        <div class="col-lg-2 col-md-0">

        </div>

    </div>


</div>

<div class="ad"> Was this free service helpful? <br>Why not <a href="http://calebcalebcaleb.com"> hire me </a> for your next web project, or <a href="http://paypal.me/calebcalebcaleb">buy me a beer</a>?
</div>

<script>
    $(document).ready(function() {
        $('#hits').DataTable();
    } );
</script>

<style>
    th, #hits_length, #hits_filter, #hits_info, #hits_next{
        color:lightgray;
    }
</style>