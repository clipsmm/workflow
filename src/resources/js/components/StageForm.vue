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
                <label class="col-sm-7">Type of Stage</label>
                <div class="col-sm-5">
                    <select v-model="form.type" class="form-control"
                            :class="{'is-invalid' : errors.first('type')}">
                        <option value="">Select Type</option>
                        <option v-for="(b, i) in types" :key="i" :value="b">{{ b }}</option>
                    </select>
                    <span v-if="errors.has('type')"
                          class='invalid-feedback'><strong>{{ errors.first('type')}}</strong></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-7">
                    Maximum duration of time an application is allowed in this stage (Days)
                </label>
                <div class="col-sm-5">
                    <input type="number" v-model="form.max_duration" class="form-control" required></input>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-7">Send expired application to another stage</label>
                <div class="col-sm-5">
                    <select v-model="form.expired_stage_id" class="form-control"
                            :class="{'is-invalid' : errors.first('expired_stage_id')}">
                        <option value="">No</option>
                        <option v-for="(b, i) in stages" :key="i" :value="b.id">{{ b.name }}</option>
                    </select>
                    <span v-if="errors.has('expired_stage_id')"
                          class='invalid-feedback'><strong>{{ errors.first('expired_stage_id')}}</strong></span>
                </div>
            </div>
        </div>
        <div class="form-group px-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" v-model="form.entity_editable" class="custom-control-input" id="rdEdit">
                <label class="custom-control-label" for="rdEdit">Allow editing of applications by reviewers with access
                    to this stage</label>
            </div>
        </div>
        <div class="form-group px-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" v-model="form.notify" class="custom-control-input" id="rdNotify">
                <label class="custom-control-label" for="rdNotify">Send notification to user when application enters
                    this stage?</label>
            </div>
        </div>
        <div class="form-group px-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" v-model="form.active" class="custom-control-input" id="rdActive">
                <label class="custom-control-label" for="rdActive">Active</label>
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
      workflow: {required: false, type: Object, default: () => {}},
      stages: {required: false, type: Array, default: () => []},
      roles: {required: false, type: Array, default: () => []},
      current: {
        required: false, type: Object, default: () => {
          return {
            name: '',
            workflow_id: '',
            max_duration: 0,
            order_no: 0,
            expired_stage_id: '',
            entity_editable: false,
            type: '',
            notify: true,
            active: false
          }
        }
      }
    },
    data: function () {
      return {
        form: this.current,
        types: [
          "Review", "Assessment", "Approved", "Rejected", "Corrections"
        ],
        bSending: false,
      }
    },
    created(){
      if(!!this.workflow.id){
        this.form.workflow_id = this.workflow.id
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
