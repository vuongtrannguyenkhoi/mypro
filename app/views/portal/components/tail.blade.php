<!-- #PAGE FOOTER -->
<div class="page-footer">
    <div class="row">

        <div class="col-lg-12">
            <div class="portal-copyright text-center txt-color-white">
                Bản quyền thuộc Công ty THHH Hưng Điền <a href="" class="pull-right txt-color-white">Design by <strong>tackedesign.com</strong></a>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- END FOOTER -->
<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->


<!-- #PLUGINS -->
{{ HTML::script('backend/js/jquery-1.10.2.min.js') }}
{{ HTML::script('backend/js/jquery-ui-1.10.3.min.js') }}

<!-- IMPORTANT: APP CONFIG -->
{{ HTML::script('backend/js/app.config.js') }}

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
{{ HTML::script('backend/smartadmin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}

<!-- BOOTSTRAP JS -->
{{ HTML::script('backend/smartadmin/js/bootstrap/bootstrap.min.js') }}

<!-- CUSTOM NOTIFICATION -->
{{ HTML::script('backend/smartadmin/js/notification/SmartNotification.min.js') }}

<!-- JARVIS WIDGETS -->
{{ HTML::script('backend/smartadmin/js/smartwidgets/jarvis.widget.min.js') }}

<!-- EASY PIE CHARTS -->
{{ HTML::script('backend/smartadmin/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js') }}

<!-- SPARKLINES -->
{{ HTML::script('backend/smartadmin/js/plugin/sparkline/jquery.sparkline.min.js') }}

<!-- JQUERY VALIDATE -->
{{ HTML::script('backend/smartadmin/js/plugin/jquery-validate/jquery.validate.min.js') }}

<!-- JQUERY MASKED INPUT -->
{{ HTML::script('backend/smartadmin/js/plugin/masked-input/jquery.maskedinput.min.js') }}

<!-- JQUERY SELECT2 INPUT -->
{{ HTML::script('backend/smartadmin/js/plugin/select2/select2.min.js') }}

<!-- JQUERY UI + Bootstrap Slider -->
{{ HTML::script('backend/smartadmin/js/plugin/bootstrap-slider/bootstrap-slider.min.js') }}

<!-- browser msie issue fix -->
{{ HTML::script('backend/smartadmin/js/plugin/msie-fix/jquery.mb.browser.min.js') }}

<!-- redactor -->
{{ HTML::script('backend/plugins/redactor/redactor.js') }}
{{ HTML::script('backend/plugins/redactor/fontfamily.js') }}
{{ HTML::script('backend/plugins/redactor/textdirection.js') }}
{{ HTML::script('backend/plugins/redactor/fullscreen.js') }}
{{ HTML::script('backend/plugins/redactor/fontcolor.js') }}

<!-- datatables -->
{{ HTML::script('backend/plugins/datatables/jquery.dataTables.min.js') }}
{{ HTML::script('backend/plugins/datatables/dataTables.colVis.min.js') }}
{{ HTML::script('backend/plugins/datatables/dataTables.tableTools.min.js') }}
{{ HTML::script('backend/plugins/datatables/dataTables.bootstrap.min.js') }}
{{ HTML::script('backend/plugins/datatable-responsive/datatables.responsive.min.js') }}
<!--[if IE 8]>
<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
<![endif]-->

<!-- MAIN APP JS FILE -->
<!--{{ HTML::script('backend/smartadmin/js/app.min.js') }}-->
{{ HTML::script('backend/js/app.js') }}

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
{{ HTML::script('backend/smartadmin/js/speech/voicecommand.min.js') }}

<script>
    function renderEditor(){

        $('.editor').redactor({
            buttons: ['html', 'formatting','underline','bold', 'italic', 'deleted',
                'unorderedlist', 'orderedlist', 'outdent', 'indent',
                'image', 'video', 'file', 'table', 'link', 'alignment', 'horizontalrule'],
            minHeight: 200,
            imageUpload: "{{ url('api/v1/redactor/images/upload') }}",
            fileUpload: "{{ url('tutor/homeworks/files/upload') }}",
            convertDivs: false,
            plugins: ['fontfamily','fontsize','textdirection','fullscreen','fontcolor']
        });
    }
</script>
</body>

</html>