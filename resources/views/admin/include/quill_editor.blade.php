@php
    $editorInputId = $inputId ?? 'description';
    $editorInputName = $inputName ?? 'description';
    $toolbarId = 'toolbar-container-' . $editorInputId;
    $editorId = 'quill-' . $editorInputId;
@endphp

<script src="{{ asset('assets/js/quill_resize.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/quill-better-table@1.2.8/dist/quill-better-table.min.css" rel="stylesheet" />
<script src="{{ asset('assets/js/quill_heighlight.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-better-table@1.2.8/dist/quill-better-table.min.js"></script>

<div id="{{ $toolbarId }}">
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
    <span class="ql-formats">
        <button class="ql-clean"></button>
    </span>
  </div>
  <div id="{{ $editorId }}">{!!$description??''!!}</div>
  <input type="hidden" id="{{ $editorInputId }}" value="{{$description??''}}" name="{{ $editorInputName }}">

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

    .ql-toolbar {
            position: sticky;
            top: 10;
            z-index: 2;
            background: white;
        }
    #{{ $editorId }} { margin-bottom: 16px; }
    .ql-toolbar.ql-snow .ql-formats
    {
        margin-right: 10px !important;
    }
    .ql-tooltip.ql-editing
    {
        left: 100px !important;
    }
</style>

<style>
    /* better-table borders visible */
    .ql-editor table{ border-collapse: collapse; width:100%; }
    .ql-editor td, .ql-editor th{ border:1px solid #cbd5e1; padding:8px; }
    .ql-editor img{ max-width:100%; }
</style>
<script type="module">
    Quill.register('modules/imageResize', QuillResizeModule);
    if(window.quillBetterTable){ Quill.register({'modules/better-table': quillBetterTable}, true); }
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

    const quill_{{ $editorInputId }} = new Quill('#{{ $editorId }}', {
        modules:
        {
            syntax: true,
            toolbar: {
                container: '#{{ $toolbarId }}',
                handlers: {
                    image: function(){
                        const input = document.createElement('input');
                        input.setAttribute('type','file');
                        input.setAttribute('accept','image/*');
                        input.click();
                        input.onchange = () => {
                            const file = input.files[0];
                            if(!file) return;
                            if(file.size > 4*1024*1024){ alert('Image max 4MB'); return; }
                            const reader = new FileReader();
                            reader.onload = () => {
                                const range = this.quill.getSelection(true);
                                this.quill.insertEmbed(range.index, 'image', reader.result, 'user');
                                this.quill.setSelection(range.index+1);
                            };
                            reader.readAsDataURL(file);
                        };
                    },
                    table: function(){
                        const tableModule = this.quill.getModule('better-table');
                        if(tableModule){ tableModule.insertTable(3,3); }
                    }
                }
            },
            table: false,
            'better-table': { operationMenu: { items: { unmergeCells:{text:'Unmerge'} } } },
            keyboard: { bindings: quillBetterTable ? quillBetterTable.keyboardBindings : undefined },
            imageResize: { modules: [ 'Resize' ] }
        },
        placeholder: 'Description — supports tables & images',
        theme: 'snow',
        scrollingContainer: '#{{ $editorId }}',
        height:300,
    });
    const _quillRef_{{ $editorInputId }} = quill_{{ $editorInputId }};
    // expose last for backward compat
    window.quill = _quillRef_{{ $editorInputId }};
    _quillRef_{{ $editorInputId }}.on('text-change', function(delta, oldDelta, source) {
        var editor_content = _quillRef_{{ $editorInputId }}.root.innerHTML;
        $('#{{ $editorInputId }}').val(editor_content);
    });

</script>
