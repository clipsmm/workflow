<template>
    <form ref="frmWorkflow">
        <div class="p-3">
            <div class="form-group">
                <label for="txtName" class="">Name</label>
                <input id="txtName" v-model="form.name" type="text" class="form-control"
                       :class="{'is-invalid' : errors.first('name')}"></input>
                <span v-if="errors.has('name')"
                      class='invalid-feedback'><strong>{{ errors.first('name')}}</strong></span>
            </div>
            <div class="form-group">
                <label for="txtType" class="">Workflow Type</label>
                <select v-model="form.type" id="txtType" class="form-control"
                        :class="{'is-invalid' : errors.first('type')}">
                    <option value="">Select Type</option>
                    <option v-for="(b, i) in types" :key="i" :value="b.name">{{ b.name }}</option>
                </select>
                <span v-if="errors.has('type')"
                      class='invalid-feedback'><strong>{{ errors.first('type')}}</strong></span>
            </div>
            <div class="form-group">
                <label for="txtDescription" class="">Workflow Description</label>
                <textarea id="txtDescription" v-model="form.description" type="text" class="form-control"
                          :class="{'is-invalid' : errors.first('description')}" rows="5"></textarea>
                <span v-if="errors.has('description')"
                      class='invalid-feedback'><strong>{{ errors.first('description')}}</strong></span>
            </div>

        </div>
        <div class="form-group px-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" v-model="form.active" class="custom-control-input" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1">Active</label>
            </div>
        </div>
        <div class="modal-footer">
            <button v-if="!cancelUrl" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a v-else class="btn btn-secondary" :href="cancelUrl">Close</a>
            <button type="button" class="btn btn-primary" @click="submit">
                <i class="fa fa-send"></i>
                Submit
            </button>
        </div>
    </form>
</template>

<script>
  export default {
    props: {
      submitUrl: {required: true, type: String},
      cancelUrl: {required: false, type: String},
      types: {required: true, type: Array},
      current: {
        required: false, type: Object, default: () => {
          return {name: '', type: '', active: true}
        }
      }
    },
    data: function () {
      return {
        form: this.current,
        bSending: false,
      }
    },
    methods: {
      submit: function () {
        this.bSending = true;
        this.$http.post(this.submitUrl, this.form)
          .then(({data, status}) => {
            this.$swal({
              icon: 'success',
              title: "Success",
              message: "Workflow changes saved successfully",
              onClose: () => window.location.reload()
            });
          })
          .catch((err) => {
            this.bSending = false;
            if (!err.response) {
              this.$swal({
                icon: 'error',
                title: "Error",
                message: err.message
              });
              return;
            }


            if (err.response.status === 422) {
              this.$swal({
                icon: 'error',
                title: "Error",
                message: err.response.data.message
              });

              this.$setLaravelValidationErrorsFromResponse(err.response.data);

            } else if (!!err.response) {
              this.$swal({
                icon: 'error',
                title: "Error",
                message: err.response.data.message
              });
            }
            return true;
          })
          .finally(() => {

          })
      }
    }
  }
</script>
