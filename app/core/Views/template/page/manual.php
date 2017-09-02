<div class="output_view" style="overflow: hidden; position: relative; border-top: 1px solid rgb(231, 231, 231); z-index: 9;width:100%;height:100%;padding:10px;">

    <iframe id="systemview" name="systemview" src="about:blank" scrolling="yes" frameborder="0" style="border: 1px solid rgb(231, 231, 231); overflow-x: hidden;background:#1f1f1f;border-radius:4px;"></iframe>

</div>


<script>

    $(document).ready(function()
    {
        document.getElementById('systemview').src = '/run/manual?s=Test\\MyScript';

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

   });
</script>
