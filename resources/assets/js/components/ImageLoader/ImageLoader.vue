<template>
    <div ref="mainContainer" class="image-uploader">
        <label class="control-label">Картинка</label>
        <div class="image-uploader__input-wrapper">
            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
            <input type="file" class="image-uploader__input" @change="previewThumbnail" :id="id" :name="id" accept="image/*">
        </div>

        <div class="image-uploader__image-wrapper">
            <i v-show="isEmpty && !isLoading" class="fa fa-picture-o fa-3x"></i>
            <i v-show="isLoading" class="fa fa-refresh fa-spin fa-3x"></i>
            <img
                    v-show="!isEmpty && !isLoading"
                    class="image-uploader__image"
                    ref="img"
                    :src="src"
                    :class="{
                               'with-info': showInfo && !isEmpty,
                               'without-info': !showInfo || isEmpty
                            }"
            >

            <pre v-show="!isEmpty && showInfo && !isLoading" class="image-uploader__image-info">{{ fileInfo }}</pre>
        </div>

    </div>
</template>

<script>
    import { FileHelper } from './file-helper.js';

  export default {
    name: "ImageLoader",
    props: {
        blogImg: {
          type: String,
          default: ''
        },
        showInfo: {
          type: Boolean,
          default: false
        },
        id: {
          type: String,
          default: 'picture'
        },
        srcPrefix: {
          type: String,
          default: '/img/',
        }

    },

    data () {
      return {
        content: null,  // New uploaded image's base64-encoded content
        selectedImage: null,
        log: null,
        isLoading: false,
        file: null
      }
    },
    computed: {
      src () {
        if (this.content) {
          return this.content;
        }
        return this.isEmpty
          ? ''
          : this.srcPrefix + this.blogImg;
      },

      fileInfo () {
        if (this.isEmpty) {
          return '';
        }
        let result = this.srcPrefix + this.blogImg;
        if (this.file instanceof File) {
          result += "\n." + this.file.type.split('/')[1] + "\n" + FileHelper.formatSize(this.file.size);
        }
        return result;
      },
      isEmpty () {
        return !Boolean(this.blogImg);
      }

    },
    methods: {
      previewThumbnail (event) {
        this.handleFiles(event.target.files)
      },

      handleFiles (files) {
        if (!files || !files[0]) {
          return;
        }
        if (!/^image\//.test(files[0].type)) {
          return;
        }
        this.selectImage(files[0]);
      },

      selectImage (file) {
        let reader = new FileReader();
        reader.onload = this.onImageLoad;
        this.isLoading = true;
        this.file = file;
        reader.readAsDataURL(file);
      },

      onImageLoad (e) {
        this.content = e.target.result;
        this.isLoading = false;
        let filename = this.file instanceof File
          ? this.file.name
          : '';
        // Dispatch input events with new blogImg and image content
        this.dispatchInputEvents(filename, this.content);
      },

      dispatchInputEvents(filename, content) {
         this.$emit('sendimage', {name:filename, file:content});
      }
    },
    mounted(){
      //console.log('src: '+this.src)
    }
  }
</script>

<style lang="css">
    /* Root container */
    .image-uploader {
        position: relative;
        display: flow-root;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    }

    /* Wrapper for file input */
    .image-uploader__input-wrapper {
        overflow: hidden;
        position: relative;
        border-radius: 4px;
        float: left;
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgba(0, 0, 0, 0.2);
        transition: 0.4s background;
        width: 40px;
    }

    .image-uploader__input-wrapper:hover {
        background: #e0e0e0;
    }

    /* Hidden file input */
    .image-uploader__input {
        position: absolute;
        display: block;
        min-height: 100%;
        opacity: 0;
        right: 0;
        top: 0;
        text-align: right;
        cursor: pointer;
    }

    /* Wrapper for image */
    .image-uploader__image-wrapper {
        height: 120px;
        border-radius: 1px;
        overflow-y: hidden;
        justify-content: center;
        align-items: center;
        text-align: center;
        vertical-align: middle;
        display: flex;
        padding: 2px;
        width: 100%;
    }

    /* Target image */
    img.image-uploader__image {
        max-height: 100%;
        height: auto;
        border: none;
        margin: auto;
        display: block;
    }

    /* Two settings for image width */
    img.image-uploader__image.with-info {
        max-width: 60%;
    }
    img.image-uploader__image.without-info {
        max-width: 100%;
    }

    /* Wrapper for image info text */
    .image-uploader__image-info {
        height: 100%;
        width: 40%;
        text-align: left;
        vertical-align: top;
        font-family: monospace, Courier, Monospaced;
        background-color: inherit;
        border: none;
        margin: 0;
        padding: 0 0 0 10px;
    }

    /* Wrapper for screen background until drag-n-drop is active */
    .image-loader__drag-n-drop-screen-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        background-color: #808080;
        opacity: 0.2;
    }

    /* Wrapper for component until drag-n-drop is active */
    .image-loader__drag-n-drop-wrapper {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
        background-color: #808080;
        opacity: 0.9;
        border: none;
        border-radius: 4px;
    }

    /* Drag-n-drop wrapper icon */
    .image-loader__drag-n-drop-text {
        position: relative;
        top: 50%;
        left: 50%;
        margin-left: -60px;
        margin-top: -56px;
        font-size: 8em;
    }

    /* Clear image icon */
    .image-loader__clear-icon {
        float: right;
        margin: 4px 4px 0 0;
        cursor: pointer;
        color: #555;
    }
</style>