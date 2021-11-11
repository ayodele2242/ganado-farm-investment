<?php

include('../inc/admins.php');  


// Set your cookie before redirecting to the login page
setcookie("redirect","", time()-3600);
$current_page = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$expire=time() + (86400 * 30);
setcookie("redirect", $current_page, $expire, "/");
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $name;  ?> - Page Builder</title>
    <meta content="Websites Builder" name="description">
    <!--//Page Builder-->
    
    <!--<link rel="stylesheet" href="../assets/page_builder/css/toastr.min.css">-->
    <link rel="stylesheet" href="../assets/page_builder/css/grapes.min.css?v0.15.3">
    <link rel="stylesheet" href="../assets/page_builder/css/grapesjs-preset-webpage.min.css">
    <link rel="stylesheet" href="../assets/page_builder/css/tooltip.css">
    <link rel="stylesheet" href="../assets/page_builder/css/grapesjs-plugin-filestack.css">
    <link rel="stylesheet" href="../assets/page_builder/css/demos.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/materialize.css">
   
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/dashboard-modern.css">

    <!-- <script src="//static.filestackapi.com/v3/filestack.js"></script> -->
    <!-- <script src="js/aviary.js"></script> old //feather.aviary.com/imaging/v3/editor.js -->
    <script type="text/javascript" src="../assets/js/jquery-1.11.1.min.js"></script>
    <!--<script src="//feather.aviary.com/imaging/v3/editor.js"></script>-->
   <!-- <script type="text/javascript" src="../assets/js/jquery-1.11.1.min.js"></script>-->
    
    
    
    <script src="../assets/page_builder/js/grapes.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/grapesjs-plugin-export@0.1.5/dist/grapesjs-plugin-export.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/grapesjs-plugin-ckeditor@0.0.9/dist/grapesjs-plugin-ckeditor.min.js"></script>


    
    <!--<script src="../assets/page_builder/js/main.js"></script>-->
    <!--<script src="//unpkg.com/grapesjs"></script>-->
    <script src="../assets/page_builder/js/toastr.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-preset-webpage.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-lory-slider.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-tabs.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-custom-code.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-touch.min.js?0.1.1"></script>
    <script src="../assets/page_builder/js/grapesjs-parser-postcss.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-tooltip.min.js?0.1.1"></script>
    <script src="../assets/page_builder/js/grapesjs-tui-image-editor.min.js"></script>
    

    <style type="text/css">

         .cke_chrome {
        border: none !important;
      }
      .cke_toolgroup {
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
      }
        .icon-add-comp::before, .icon-comp100::before,.icon-comp50::before,.icon-comp30::before,.icon-rm::before{ content: '';}
        .icon-add-comp {
          background: url("../assets/page_builder/img/icon-sq-a.png") no-repeat center;
        }
        .icon-comp100 {
          background: url("../assets/page_builder/img/icon-sq-1.png") no-repeat center;
        }
        .icon-comp50 {
          background: url("../assets/page_builder/img/icon-sq-2.png") no-repeat center;
        }
        .icon-comp30 {
          background: url("../assets/page_builder/img/icon-sq-3.png") no-repeat center;
        }
        .icon-rm {
          background: url("../assets/page_builder/img/icon-sq-r.png") no-repeat center;
        }

        .icons-flex {
          background-size: 70% 65% !important;
          height: 15px;
          width: 17px;
          opacity: 0.9;
        }
        .icon-dir-row {
          background: url("../assets/page_builder/img/flex-dir-row.png") no-repeat center;
        }
        .icon-dir-row-rev {
          background: url("../assets/page_builder/img/flex-dir-row-rev.png") no-repeat center;
        }
        .icon-dir-col {
          background: url("../assets/page_builder/img/flex-dir-col.png") no-repeat center;
        }
        .icon-dir-col-rev {
          background: url("../assets/page_builder/img/flex-dir-col-rev.png") no-repeat center;
        }
        .icon-just-start{
         background: url("../assets/page_builder/img/flex-just-start.png") no-repeat center;
        }
        .icon-just-end{
         background: url("../assets/page_builder/img/flex-just-end.png") no-repeat center;
        }
        .icon-just-sp-bet{
         background: url("../assets/page_builder/img/flex-just-sp-bet.png") no-repeat center;
        }
        .icon-just-sp-ar{
         background: url("../assets/page_builder/img/flex-just-sp-ar.png") no-repeat center;
        }
        .icon-just-sp-cent{
         background: url("../assets/page_builder/img/flex-just-sp-cent.png") no-repeat center;
        }
        .icon-al-start{
         background: url("../assets/page_builder/img/flex-al-start.png") no-repeat center;
        }
        .icon-al-end{
         background: url("../assets/page_builder/img/flex-al-end.png") no-repeat center;
        }
        .icon-al-str{
         background: url("../assets/page_builder/img/flex-al-str.png") no-repeat center;
        }
        .icon-al-center{
         background: url("../assets/page_builder/img/flex-al-center.png") no-repeat center;
        }

         [data-tooltip]::after {
           background: rgba(51, 51, 51, 0.9);
         }

         .gjs-pn-commands {
           min-height: 40px;
         }

         #gjs-sm-float,
         .gjs-pn-views .fa-cog {
            display: none;
         }

         .gjs-am-preview-cont {
           height: 100px;
           width: 100%;
         }

         .gjs-logo-version {
           background-color: #756467;
         }

        .gjs-pn-panel.gjs-pn-views {
          padding: 0;
          border-bottom: none;
        }

        .gjs-pn-btn.gjs-pn-active {
          box-shadow: none;
        }

        .gjs-pn-views .gjs-pn-btn {
            margin: 0;
            height: 40px;
            padding: 10px;
            width: 33.3333%;
            border-bottom: 2px solid rgba(0, 0, 0, 0.3);
        }

        .CodeMirror {
          min-height: 450px;
          margin-bottom: 8px;
        }

        .mtext{
          font-weight: bolder;
          font-size: 16px;
          color: #fff;

        }
        .btn_d{
          color: skyblue;
          
          font-weight: bolder;
          padding: 7px;
          margin-top: 8px;
        }
    </style>
  </head>
  <body>
    
    <div class="ad-cont">
      <div class="row" id="native-carbon" style="text-align: center;">
 <div class="col-lg-12"> 
  <div class="form-group mb-2" >
    <label class="alert alert-info text-danger mtext">Select Page Link</label>  
        <select name="plink" class="form-control browser-default mselect select" id="pageName">
          <?php 
          echo menu_list();
          ?>
        </select>
  </div>
 <button class="btn btn-sm btn-success" id="submitIt">Submit</button><br>
 <a href="dashboard" class="btn_d">Back to Dashboard</a>
 </div>      


        

      </div>
      <script async type="text/javascript" src="../assets/page_builder/js/carbon.js"></script>
    </div> 
  

    <div id="gjs" style="height:0px; overflow:hidden">
     
    </div>

   

    <script type="text/javascript">
      var lp = '<?php echo $set['storeName']; ?>/assets/page_builder/img/';
      var plp = '//placehold.it/350x250/';
      var images = [
        lp+'team1.jpg', lp+'team2.jpg', lp+'team3.jpg', plp+'78c5d6/fff/image1.jpg', plp+'459ba8/fff/image2.jpg', plp+'79c267/fff/image3.jpg',
        plp+'c5d647/fff/image4.jpg', plp+'f28c33/fff/image5.jpg', plp+'e868a2/fff/image6.jpg', plp+'cc4360/fff/image7.jpg',
        lp+'work-desk.jpg', lp+'phone-app.png', lp+'bg-gr-v.png'
      ];

      var editor  = grapesjs.init({
        avoidInlineStyle: 1,
        height: '100%',
        container : '#gjs',
        fromElement: 1,
        showOffsets: 1,
        assetManager: {
          embedAsBase64: 1,
          assets: images
        },
        panels: {
          defaults: []
        },


        styleManager: { clearProperties: 1 },
        plugins: [
          'gjs-plugin-ckeditor',
          'gjs-preset-webpage',
          'grapesjs-lory-slider',
          'grapesjs-tabs',
          'grapesjs-custom-code',
          'grapesjs-touch',
          'grapesjs-parser-postcss',
          'grapesjs-tooltip',
          'grapesjs-tui-image-editor',
          
          
        ],
        pluginsOpts: {
         /* 'gjs-navbar': {
            Blocks: 'h-navbar'
          },*/
        'gjs-plugin-ckeditor': {
                    position: 'center',
                    options: {
                        startupFocus: true,
                        // Allows any class and any inline style
                        extraAllowedContent: '*(*);*{*}',
                        // Disable auto-formatting, class removing, etc.
                        allowedContent: true,
                        enterMode: CKEDITOR.ENTER_BR,
                        extraPlugins: 'sharedspace,justify,colorbutton,panelbutton,font',
                        toolbar: [
                            { name: 'styles', items: ['Font', 'FontSize' ] },
                            ['Bold', 'Italic', 'Underline', 'Strike'],
                            { name: 'paragraph', items : [ 'NumberedList', 'BulletedList'] },
                            { name: 'links', items: ['Link', 'Unlink'] },
                            { name: 'colors', items: [ 'TextColor', 'BGColor' ] }
                        ]
                    }
                },
          'grapesjs-lory-slider': {
            sliderBlock: {
              category: 'Extra'
            }
          },
          'grapesjs-tabs': {
            tabsBlock: {
              category: 'Extra'
            }
          },
          'gjs-preset-webpage': {
            modalImportTitle: 'Import Template',
            modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
            modalImportContent: function(editor) {
              return editor.getHtml() + '<style>'+editor.getCss()+'</style>'
            },
            filestackOpts: null, //{ key: 'AYmqZc2e8RLGLE7TGkX3Hz' },
            aviaryOpts: false,
            blocksBasicOpts: { 
              blocks: ['link-block', 'quote', 'image', 'video', 'text', 'column1', 'column2', 'column3'], stylePrefix: 'ch-',
              flexGrid: 1 

            },
            customStyleManager: [{
              name: 'General',
              buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'],
              properties:[{
                  name: 'Alignment',
                  property: 'float',
                  type: 'radio',
                  defaults: 'none',
                  list: [
                    { value: 'none', className: 'fa fa-times'},
                    { value: 'left', className: 'fa fa-align-left'},
                    { value: 'right', className: 'fa fa-align-right'}
                  ],
                },
                { property: 'position', type: 'select'}
              ],
            },{
                name: 'Dimension',
                open: false,
                buildProps: ['width', 'flex-width', 'height', 'max-width', 'min-height', 'margin', 'padding'],
                properties: [{
                  id: 'flex-width',
                  type: 'integer',
                  name: 'Width',
                  units: ['px', '%'],
                  property: 'flex-basis',
                  toRequire: 1,
                },{
                  property: 'margin',
                  properties:[
                    { name: 'Top', property: 'margin-top'},
                    { name: 'Right', property: 'margin-right'},
                    { name: 'Bottom', property: 'margin-bottom'},
                    { name: 'Left', property: 'margin-left'}
                  ],
                },{
                  property  : 'padding',
                  properties:[
                    { name: 'Top', property: 'padding-top'},
                    { name: 'Right', property: 'padding-right'},
                    { name: 'Bottom', property: 'padding-bottom'},
                    { name: 'Left', property: 'padding-left'}
                  ],
                }],
              },{
                name: 'Typography',
                open: false,
                buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow'],
                properties:[
                  { name: 'Font', property: 'font-family'},
                  { name: 'Weight', property: 'font-weight'},
                  { name:  'Font color', property: 'color'},
                  {
                    property: 'text-align',
                    type: 'radio',
                    defaults: 'left',
                    list: [
                      { value : 'left',  name : 'Left',    className: 'fa fa-align-left'},
                      { value : 'center',  name : 'Center',  className: 'fa fa-align-center' },
                      { value : 'right',   name : 'Right',   className: 'fa fa-align-right'},
                      { value : 'justify', name : 'Justify',   className: 'fa fa-align-justify'}
                    ],
                  },{
                    property: 'text-decoration',
                    type: 'radio',
                    defaults: 'none',
                    list: [
                      { value: 'none', name: 'None', className: 'fa fa-times'},
                      { value: 'underline', name: 'underline', className: 'fa fa-underline' },
                      { value: 'line-through', name: 'Line-through', className: 'fa fa-strikethrough'}
                    ],
                  },{
                    property: 'text-shadow',
                    properties: [
                      { name: 'X position', property: 'text-shadow-h'},
                      { name: 'Y position', property: 'text-shadow-v'},
                      { name: 'Blur', property: 'text-shadow-blur'},
                      { name: 'Color', property: 'text-shadow-color'}
                    ],
                }],
              },{
                name: 'Decorations',
                open: false,
                buildProps: ['opacity', 'background-color', 'border-radius', 'border', 'box-shadow', 'background'],
                properties: [{
                  type: 'slider',
                  property: 'opacity',
                  defaults: 1,
                  step: 0.01,
                  max: 1,
                  min:0,
                },{
                  property: 'border-radius',
                  properties  : [
                    { name: 'Top', property: 'border-top-left-radius'},
                    { name: 'Right', property: 'border-top-right-radius'},
                    { name: 'Bottom', property: 'border-bottom-left-radius'},
                    { name: 'Left', property: 'border-bottom-right-radius'}
                  ],
                },{
                  property: 'box-shadow',
                  properties: [
                    { name: 'X position', property: 'box-shadow-h'},
                    { name: 'Y position', property: 'box-shadow-v'},
                    { name: 'Blur', property: 'box-shadow-blur'},
                    { name: 'Spread', property: 'box-shadow-spread'},
                    { name: 'Color', property: 'box-shadow-color'},
                    { name: 'Shadow type', property: 'box-shadow-type'}
                  ],
                },{
                  property: 'background',
                  properties: [
                    { name: 'Image', property: 'background-image'},
                    { name: 'Repeat', property:   'background-repeat'},
                    { name: 'Position', property: 'background-position'},
                    { name: 'Attachment', property: 'background-attachment'},
                    { name: 'Size', property: 'background-size'}
                  ],
                },],
              },{
                name: 'Extra',
                open: false,
                buildProps: ['transition', 'perspective', 'transform'],
                properties: [{
                  property: 'transition',
                  properties:[
                    { name: 'Property', property: 'transition-property'},
                    { name: 'Duration', property: 'transition-duration'},
                    { name: 'Easing', property: 'transition-timing-function'}
                  ],
                },{
                  property: 'transform',
                  properties:[
                    { name: 'Rotate X', property: 'transform-rotate-x'},
                    { name: 'Rotate Y', property: 'transform-rotate-y'},
                    { name: 'Rotate Z', property: 'transform-rotate-z'},
                    { name: 'Scale X', property: 'transform-scale-x'},
                    { name: 'Scale Y', property: 'transform-scale-y'},
                    { name: 'Scale Z', property: 'transform-scale-z'}
                  ],
                }]
              },{
                name: 'Flex',
                open: false,
                properties: [{
                  name: 'Flex Container',
                  property: 'display',
                  type: 'select',
                  defaults: 'block',
                  list: [
                    { value: 'block', name: 'Disable'},
                    { value: 'flex', name: 'Enable'}
                  ],
                },{
                  name: 'Flex Parent',
                  property: 'label-parent-flex',
                  type: 'integer',
                },{
                  name      : 'Direction',
                  property  : 'flex-direction',
                  type    : 'radio',
                  defaults  : 'row',
                  list    : [{
                            value   : 'row',
                            name    : 'Row',
                            className : 'icons-flex icon-dir-row',
                            title   : 'Row',
                          },{
                            value   : 'row-reverse',
                            name    : 'Row reverse',
                            className : 'icons-flex icon-dir-row-rev',
                            title   : 'Row reverse',
                          },{
                            value   : 'column',
                            name    : 'Column',
                            title   : 'Column',
                            className : 'icons-flex icon-dir-col',
                          },{
                            value   : 'column-reverse',
                            name    : 'Column reverse',
                            title   : 'Column reverse',
                            className : 'icons-flex icon-dir-col-rev',
                          }],
                },{
                  name      : 'Justify',
                  property  : 'justify-content',
                  type    : 'radio',
                  defaults  : 'flex-start',
                  list    : [{
                            value   : 'flex-start',
                            className : 'icons-flex icon-just-start',
                            title   : 'Start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-just-end',
                          },{
                            value   : 'space-between',
                            title    : 'Space between',
                            className : 'icons-flex icon-just-sp-bet',
                          },{
                            value   : 'space-around',
                            title    : 'Space around',
                            className : 'icons-flex icon-just-sp-ar',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-just-sp-cent',
                          }],
                },{
                  name      : 'Align',
                  property  : 'align-items',
                  type    : 'radio',
                  defaults  : 'center',
                  list    : [{
                            value   : 'flex-start',
                            title    : 'Start',
                            className : 'icons-flex icon-al-start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-al-end',
                          },{
                            value   : 'stretch',
                            title    : 'Stretch',
                            className : 'icons-flex icon-al-str',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-al-center',
                          }],
                },{
                  name: 'Flex Children',
                  property: 'label-parent-flex',
                  type: 'integer',
                },{
                  name:     'Order',
                  property:   'order',
                  type:     'integer',
                  defaults :  0,
                  min: 0
                },{
                  name    : 'Flex',
                  property  : 'flex',
                  type    : 'composite',
                  properties  : [{
                          name:     'Grow',
                          property:   'flex-grow',
                          type:     'integer',
                          defaults :  0,
                          min: 0
                        },{
                          name:     'Shrink',
                          property:   'flex-shrink',
                          type:     'integer',
                          defaults :  0,
                          min: 0
                        },{
                          name:     'Basis',
                          property:   'flex-basis',
                          type:     'integer',
                          units:    ['px','%',''],
                          unit: '',
                          defaults :  'auto',
                        }],
                },{
                  name      : 'Align',
                  property  : 'align-self',
                  type      : 'radio',
                  defaults  : 'auto',
                  list    : [{
                            value   : 'auto',
                            name    : 'Auto',
                          },{
                            value   : 'flex-start',
                            title    : 'Start',
                            className : 'icons-flex icon-al-start',
                          },{
                            value   : 'flex-end',
                            title    : 'End',
                            className : 'icons-flex icon-al-end',
                          },{
                            value   : 'stretch',
                            title    : 'Stretch',
                            className : 'icons-flex icon-al-str',
                          },{
                            value   : 'center',
                            title    : 'Center',
                            className : 'icons-flex icon-al-center',
                          }],
                }]
              }
            ],
          },
        },

      });

  /*editor.BlockManager.get('id-of-the-block').set({
  content: {
    type: 'link',
    content:'Text for the link',
    attributes: { href: '...' }
  }
  });*/

  
      var pn = editor.Panels;
      var modal = editor.Modal;
      var cmdm = editor.Commands;
      cmdm.add('canvas-clear', function() {
        if(confirm('Are you sure to clean the canvas?')) {
          var comps = editor.DomComponents.clear();
          setTimeout(function(){ localStorage.clear()}, 0)
        }
      });
      cmdm.add('set-device-desktop', {
        run: ed => ed.setDevice('Desktop'),
        stop() {},
      });
      cmdm.add('set-device-tablet', {
        run: ed => ed.setDevice('Tablet'),
        stop() {},
      });
      cmdm.add('set-device-mobile', {
        run: ed => ed.setDevice('Mobile portrait'),
        stop() {},
      });



      // Add info command
      var mdlClass = 'gjs-mdl-dialog-sm';
      var infoContainer = document.getElementById('info-panel');
      cmdm.add('open-info', function() {
        var mdlDialog = document.querySelector('.gjs-mdl-dialog');
        mdlDialog.className += ' ' + mdlClass;
        infoContainer.style.display = 'block';
        modal.setTitle('About this demo');
        modal.setContent(infoContainer);
        modal.open();
        modal.getModel().once('change:open', function() {
          mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
        })
      });
     /* pn.addButton('options', {
        id: 'open-info',
        className: 'fa fa-question-circle',
        command: function() { editor.runCommand('open-info') },
        attributes: {
          'title': 'About',
          'data-tooltip-pos': 'bottom',
        },
      });*/



      // Simple warn notifier
      var origWarn = console.warn;
      toastr.options = {
        closeButton: true,
        preventDuplicates: true,
        showDuration: 250,
        hideDuration: 150
      };
      console.warn = function (msg) {
        if (msg.indexOf('[undefined]') == -1) {
          toastr.warning(msg);
        }
        origWarn(msg);
      };


      // Add and beautify tooltips
      [['sw-visibility', 'Show Borders'], ['preview', 'Preview'], ['fullscreen', 'Fullscreen'],
       ['export-template', 'Export'], ['undo', 'Undo'], ['redo', 'Redo'],
       ['gjs-open-import-webpage', 'Import'], ['canvas-clear', 'Clear canvas']]
      .forEach(function(item) {
        pn.getButton('options', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      [['open-sm', 'Style Manager'], ['open-layers', 'Layers'], ['open-blocks', 'Blocks']]
      .forEach(function(item) {
        pn.getButton('views', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
      });
      var titles = document.querySelectorAll('*[title]');

      for (var i = 0; i < titles.length; i++) {
        var el = titles[i];
        var title = el.getAttribute('title');
        title = title ? title.trim(): '';
        if(!title)
          break;
        el.setAttribute('data-tooltip', title);
        el.setAttribute('title', '');
      }

      // Show borders by default
      pn.getButton('options', 'sw-visibility').set('active', 1);


      // Store and load events
      editor.on('storage:load', function(e) { console.log('Loaded ', e) });
      editor.on('storage:store', function(e) { console.log('Stored ', e) });


      // Do stuff on load
      editor.on('load', function() {
        var $ = grapesjs.$;

        // Show logo with the version
        var logoCont = document.querySelector('.gjs-logo-cont');
        //document.querySelector('.gjs-logo-version').innerHTML = 'v' + grapesjs.version;
        var logoPanel = document.querySelector('.gjs-pn-commands');
       // logoPanel.appendChild(logoCont);


        // Load and show settings and style manager
        var openTmBtn = pn.getButton('views', 'open-tm');
        openTmBtn && openTmBtn.set('active', 1);
        var openSm = pn.getButton('views', 'open-sm');
        openSm && openSm.set('active', 1);

        // Add Settings Sector
        var traitsSector = $('<div class="gjs-sm-sector no-select">'+
          '<div class="gjs-sm-title"><span class="icon-settings fa fa-cog"></span> Settings</div>' +
          '<div class="gjs-sm-properties" style="display: none;"></div></div>');
        var traitsProps = traitsSector.find('.gjs-sm-properties');
        traitsProps.append($('.gjs-trt-traits'));
        $('.gjs-sm-sectors').before(traitsSector);
        traitsSector.find('.gjs-sm-title').on('click', function(){
          var traitStyle = traitsProps.get(0).style;
          var hidden = traitStyle.display == 'none';
          if (hidden) {
            traitStyle.display = 'block';
          } else {
            traitStyle.display = 'none';
          }
        });

        // Open block manager
        var openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
        openBlocksBtn && openBlocksBtn.set('active', 1);



        // Move Ad
        $('#gjs').append($('.ad-cont'));
      });

      /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-74284223-1', 'auto');
      ga('send', 'pageview');*/


//$('#submitIt').on('click', function() {
$("#submitIt").click(function() {

  var pageName =  $("select#pageName").val();
  var htmldata = editor.getHtml();
  var cssdata = editor.getCss();
  //alert(pageName +' '+htmldata +' '+cssdata);
 
  //console.log(htmldata);
  //console.log(cssdata);

   $.post("../inc/page/builder.php", {"html":htmldata, "css":cssdata,"link":pageName }, 
    function(data) {
        if(data == "added"){
            //$('#email_status').prop( "checked", false );
            var comps = editor.DomComponents.clear();
             setTimeout(function(){ localStorage.clear()}, 0);
             alert("Content created successfully");
             
        }else{
           alert("Error occured "+ data);
            //alert(data);
        }
        
    });


});



    </script>
  </body>
</html>
