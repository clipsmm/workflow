<template>
    <form ref="frmWorkflow">
        <div class="p-3">
            <div class="form-group">
                <label class="">Name</label>
                <input v-model="form.name" type="text" class="form-control"
                       :class="{'is-invalid' : errors.first('name')}"></input>
                <span v-if="errors.has('name')"
                      class='invalid-feedback'><strong>{{ errors.first('name')}}</strong></span>
            </div>
            <div class="form-group row">
                <label class="col-sm-7">Type of Action</label>
                <div class="col-sm-5">
                    <select v-model="form.button" class="form-control"
                            :class="{'is-invalid' : errors.first('button')}">
                        <option value="">Select Type</option>
                        <option v-for="(b, i) in types" :key="i" :value="b">{{ b }}</option>
                    </select>
                    <span v-if="errors.has('button')"
                          class='invalid-feedback'><strong>{{ errors.first('button')}}</strong></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-7">Choose next Stage</label>
                <div class="col-sm-5">
                    <select v-model="form.next_stage_id" class="form-control"
                            :class="{'is-invalid' : errors.first('next_stage_id')}">
                        <option value="">Select</option>
                        <option v-for="(b, i) in stages" :key="i" :value="b.id">{{ b.name }}</option>
                    </select>
                    <span v-if="errors.has('next_stage_id')"
                          class='invalid-feedback'><strong>{{ errors.first('next_stage_id')}}</strong></span>
                </div>
            </div>
            <div class="form-group px-3">
                <div class="custom-control custom-switch">
                    <input type="checkbox" v-model="form.active" class="custom-control-input" id="rdActive">
                    <label class="custom-control-label" for="rdActive">Active</label>
                </div>
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
      stage: {
        required: false, type: Object, default: () => {
        }
      },
      stages: {required: false, type: Array, default: () => []},
      current: {
        required: false, type: Object, default: () => {
          return {
            name: '',
            stage_id: '',
            next_stage_id: '',
            button: '',
            active: true
          }
        }
      }
    },
    data: function () {
      return {
        form: this.current,
        types: [
          "Approve", "Reject", "Move To",
        ],
        bSending: false,
      }
    },
    created() {
      if (!!this.stage.id) {
        this.form.stage_id = this.stage.id
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
              message: "Workflow action changes saved successfully",
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
