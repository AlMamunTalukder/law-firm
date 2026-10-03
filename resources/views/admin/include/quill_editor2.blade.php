<div id="toolbar-container-two">
    <span class="ql-formats">
      <select class="ql-font"></select>
      <select class="ql-size"></select>
      <select class="ql-color"></select>
      <select class="ql-background"></select>
    </span>
    <span class="ql-formats">
      <button class="ql-bold"></button>
      <button class="ql-italic"></button>
      <button class="ql-underline"></button>
      <button class="ql-strike"></button>
      <button class="ql-script" value="sub"></button>
      <button class="ql-script" value="super"></button>
    </span>

    <span class="ql-formats">
      <button class="ql-list" value="ordered"></button>
      <button class="ql-list" value="bullet"></button>
      <button class="ql-indent" value="-1"></button>
      <button class="ql-indent" value="+1"></button>
      <button class="ql-direction" value="rtl"></button>
      <select class="ql-align"></select>
    </span>
    <span class="ql-formats">
        <button class="ql-link"></button>
        <button class="ql-image"></button>
        <button class="ql-video"></button>
        <button class="ql-table"></button>
      <button class="ql-blockquote"></button>
    </span>
  </div>
  <div id="quill_2">{!!$description_2??''!!}</div>
  <input type="hidden" id="description_2" value="{{$description_2??''}}" name="{{$name??'description_2'}}">

<style>
    .ql-container
    {
        height: calc(100% - 42px);
    }
    .ql-editor{
        min-height:300px;
        max-height:500px;
        overflow-y:scroll;
    }
    #editor-resizer .toolbar-container-two {

        z-index: 1000;
    }

    .ql-toolbar {
            position: sticky;
            top: 10;
            z-index: 1000;
            background: white;
        }
    .ql-toolbar.ql-snow .ql-formats
    {
        margin-right: 10px !important;
    }
    .ql-tooltip.ql-editing
    {
        left: 100px !important;
    }
</style>

<script type="module">
    Quill.register('modules/imageResize', QuillResizeModule);
    var BaseImageFormat = Quill.import('formats/image');
    var BaseVideoFormat = Quill.import('formats/video');

    const ImageFormatAttributesList = [
        'alt',
        'height',
        'width',
        'style'
    ];

    class ImageFormat extends BaseImageFormat {
        static formats(domNode) {
            return ImageFormatAttributesList.reduce(function(formats, attribute) {
            if (domNode.hasAttribute(attribute)) {
                formats[attribute] = domNode.getAttribute(attribute);
            }
            return formats;
            }, {});
        }
        format(name, value) {
            if (ImageFormatAttributesList.indexOf(name) > -1) {
            if (value) {
                this.domNode.setAttribute(name, value);
            } else {
                this.domNode.removeAttribute(name);
            }
            } else {
            super.format(name, value);
            }
        }
    }
    Quill.register(ImageFormat, true);

    class VideoFormat extends BaseVideoFormat {
        static formats(domNode) {
            return ImageFormatAttributesList.reduce(function(formats, attribute) {
            if (domNode.hasAttribute(attribute)) {
                formats[attribute] = domNode.getAttribute(attribute);
            }
            return formats;
            }, {});
        }
        format(name, value) {
            if (ImageFormatAttributesList.indexOf(name) > -1) {
            if (value) {
                this.domNode.setAttribute(name, value);
            } else {
                this.domNode.removeAttribute(name);
            }
            } else {
            super.format(name, value);
            }
        }
    }
    Quill.register(VideoFormat, true);

    const quill = new Quill('#quill_2', {
        modules:
        {
            syntax: true,
            toolbar: '#toolbar-container-two',
            imageResize: {
                modules: [ 'Resize' ]
            }
        },
        placeholder: 'Description',
        theme: 'snow',
        scrollingContainer: "#quill_2",
        height:300,
    });
    quill.on('text-change', function(delta, oldDelta, source) {

        var editor_content = quill.root.innerHTML;
        $('#description_2').val(editor_content);
    });

</script>
