<template>
    <el-dialog title="Images browser"
               :visible="visible"
               @close="$emit('close')"
               center
               width="94%"
    >
        <div class="grid-container grid gap-1 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-7">
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

<style scoped>
    .grid-container > * {
        @apply mx-auto;
    }
</style>