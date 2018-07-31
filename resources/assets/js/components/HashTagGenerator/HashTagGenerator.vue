<template>
    <div :id="this.id">
        <!--<label for="blog_hashtags" class="control-label">Хеш теги</label>-->
        <p>Хеш теги</p>
        <div class="input-group margin">
            <div class="input-group-btn">
                <button
                        v-show="enableButton"
                        class="btn btn-info btn-flat"
                        @click.prevent = "generateHashTag"
                        title = 'генератор хештегов из заголовка'
                ><i class="fa fa-tags"></i></button>
            </div>
            <input type="text" v-model="HashTag" class="form-control blog-hashtags" @change.prevent = "sendHashTag">
        </div>
    </div>    
</template>

<script>

  transliterate = (
    function() {
      var
        rus = "щ   ш  ч  ц  ю  я  ё  ж  ъ  ы  э  а б в г д е з и й к л м н о п р с т у ф х  ь".split(/ +/g),
        eng = "shh sh ch cz yu ya yo zh ' y  e  a b v g d e z i j k l m n o p r s t u f kh ' ".split(/ +/g);
      return function(text, engToRus) {
        var x;
        for(x = 0; x < rus.length; x++) {
          text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
          text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase());
        }
        return text;
      }
    }
  )();

  export default {
    name: "HashTagGenerator",
    props: {
      id: {
        type: String,
        default: ''
      },
      blogHeader:{
        type: String,
        default: ''
      },
      hashTag:{
          type: String,
          default: ''
      }
    },
    data (){
      return {
        HashTag: null,
        BlogHeader: null,
        enableButton: true
      }
    },


    methods:{
      loadData: function () {
        this.HashTag = this.hashTag;
        this.BlogHeader = this.blogHeader;

        if (this.HashTag) {
          this.enableButton = false
        } else {
          this.enableButton = true
        }
      },

      generateHashTag () {
        if (this.BlogHeader){
          let header = transliterate(this.BlogHeader);
           let arr = header.split(' ');
           arr.forEach( function(item, index, Arr){
               Arr.splice(index, 1, '#' + item);
           });
           this.HashTag = arr.join(' ');
           this.sendHashTag();
        }
      },
      sendHashTag (){
        this.$emit('sendhashtag', this.HashTag);
      }
    },
    watch: {
      blogHeader () {
       this.loadData()
      }
    }
  }
</script>

<style scoped>
    .blog-hashtags {
        width: 100%;
    }

</style>