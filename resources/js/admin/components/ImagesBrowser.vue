<template>
    <el-dialog title="Images browser"
               :visible="visible"
               @close="$emit('close')"
               center
    >
        <div class="flex flex-row flex-wrap justify-center">
            <el-upload
                    :action="imagesUrl"
                    :data="{path: 'products'}"
                    name="image"
                    :show-file-list="false"
                    list-type="picture-card"
                    :on-success="handleSuccessUpload"
                    class="m-2"
            >
                <i class="el-icon-plus"></i>
            </el-upload>

            <el-image v-for="image in images"
                      :key="image.id"
                      :src="image.url"
                      fit="contain"
                      style="width: 150px; height: 150px"
                      :class="[
                        'm-2 rounded-lg border-4 border-grey-600  bg-white',
                        {'border-green-400': selected.some(i => i.id === image.id)}
                      ]"
                      @click="toggleSelect(image)"
                      lazy
            />
        </div>
    </el-dialog>
</template>

<script>
  import { mapGetters, mapActions, mapMutations } from 'vuex'
  import axios from 'axios'

  export default {
    name: 'ImagesBrowser',
    props: {
      visible: {
        type: Boolean,
        default: () => false,
      },
      multiple: {
        type: Boolean,
        default: () => false,
      },
      selectedImages: {
        type: Array,
        default: () => [],
      }
    },
    data() {
      return {
        selected: [],
        imagesUrl: axios.defaults.baseURL+'/images',
      }
    },
    computed: {
      ...mapGetters({
        images: 'image/images',
        image: 'image/image',
      })
    },
    methods: {
      ...mapActions({
        fetchImages: 'image/fetchImages',

      }),
      ...mapMutations({
        setImage: 'image/setImage',
        clearImage: 'image/clearImage',
      }),
      toggleSelect(image) {
        if (this.multiple) {
          if(this.selected.includes(image)){
            this.selected.splice(this.selected.indexOf(image), 1)
          } else {
            this.selected.push(image)
          }
        } else {
          this.selected = [image]
        }

        this.$emit('selected',
          this.multiple ? this.selected : this.selected[0]
        )
      },
      async handleSuccessUpload(response, file, fileList) {
        await this.fetchImages({page: -1})
        this.setImage(response.data)
        this.toggleSelect(this.image)
        this.$notify.success("Image uploaded")
      },
    },
    async mounted () {
      await this.fetchImages({page: -1})

      this.selected = this.images.filter(i => this.selectedImages.includes(i.id))
    }
  }
</script>

<style scoped>

</style>