<template>
    <el-dialog title="Images browser"
               :visible="visible"
               @close="$emit('close')"
               center
    >
        <div class="flex flex-row flex-wrap images-browser">
            <div class="grid-container">
                <el-upload
                        action=""
                        :http-request="store"
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
      },
      path: {
        type: String,
        default: null
      }
    },
    data() {
      return {
        selected: [],
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
        storeImage: 'image/storeImage',
      }),
      ...mapMutations({
        setImage: 'image/setImage',
        clearImage: 'image/clearImage',
      }),
      store(data) {
        let formData = new FormData()
        formData.append('path', this.path)
        formData.append('image', data.file, data.file.name)
        this.storeImage(formData)
      },
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

<style>
    .images-browser .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    }
    .images-browser .grid-container > div,
    .images-browser .grid-container .el-upload--picture-card {
        width: auto !important;
        height: auto !important;
    }
    .images-browser .grid-container .el-upload--picture-card {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100% !important;
    }
    @media screen and (max-width: 1200px) {
        .images-browser .grid-container {
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }
    }
    @media screen and (max-width: 992px) {
        .images-browser .grid-container {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }
    @media screen and (max-width: 768px) {
        .images-browser .grid-container {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media screen and (max-width: 576px) {
        .images-browser .grid-container {
            grid-template-columns: 1fr;
        }
        .images-browser .grid-container .el-upload--picture-card {
            height: 100px !important;
        }
    }
</style>