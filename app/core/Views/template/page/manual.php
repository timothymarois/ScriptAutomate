<div class="output_view" style="overflow: hidden; position: relative; border-top: 1px solid rgb(231, 231, 231); z-index: 9;width:100%;height:100%;padding:10px; border-top: 1px solid rgb(58, 58, 58);border-top: 1px solid rgb(33, 33, 33);">

    <iframe id="systemview" name="systemview" src="about:blank" scrolling="yes" frameborder="0" style="border: 1px solid rgb(231, 231, 231); overflow-x: hidden;background:#1f1f1f;border-radius:4px; border: 1px solid rgb(78, 78, 78);"></iframe>

</div>


<script>

    $(document).ready(function()
    {
        // document.getElementById('systemview').src = '/run/Test';

        $('.output_view').width(($(window).width()-20));
        $('.output_view').height(($(window).height()-82));

        $('#systemview').width(($('.output_view').width()-2));
        $('#systemview').height(($('.output_view').height()-2));


        $(window).on('resize',function()
        {
            $('.output_view').width(($(window).width()-20));
            $('.output_view').height(($(window).height()-82));

            $('#systemview').width(($('.output_view').width()-2));
            $('#systemview').height(($('.output_view').height()-2));
        });


        $(document).ready(function() {
            $(".select2").select2();
        });

   });
</script>
