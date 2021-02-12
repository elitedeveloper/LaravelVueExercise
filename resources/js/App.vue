<template>
    <div class="mt-5 container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Street Address Management</div>

                    <div class="card-body">

                        <b-button v-b-modal.modal-add-postal>Add Postal Code</b-button>

                        <b-button v-b-modal.modal-add-street>Add Street</b-button>

                        <b-modal ref="modal-add-postal" hide-footer id="modal-add-postal" title="Add New Postal Code">
                            <div>
                                    <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                                      <b-form-group
                                        id="input-group"
                                        label="Postal Code:"
                                        label-for="input-postalcode"
                                        >

                                        <b-form-input
                                        id="input-postalcode"
                                        type="number"
                                        placeholder="Enter Postal Code"
                                        v-model="postalcode.id"
                                        ></b-form-input>

                                        </b-form-group>

                                        <b-form-group
                                        id="input-group"
                                        label="Country:"
                                        label-for="input-country"
                                        >

                                        <b-form-input
                                        id="input-country"
                                        type="text"
                                        placeholder="Enter Country"
                                        v-model="postalcode.country"
                                        ></b-form-input>

                                        </b-form-group>


                                        <b-form-group
                                        id="input-group"
                                        label="Locality:"
                                        label-for="input-locality"
                                        >

                                        <b-form-input
                                        id="input-locality"
                                        type="text"
                                        placeholder="Enter Locality"
                                        v-model="postalcode.locality"
                                        ></b-form-input>

                                        </b-form-group>

                                         <b-form-group
                                        id="input-group"
                                        label="Latitude:"
                                        label-for="input-latitude"
                                        >

                                        <b-form-input
                                        id="input-latitude"
                                        type="number"
                                        placeholder="Enter Latitude"
                                        v-model="postalcode.latitude"
                                        ></b-form-input>

                                        </b-form-group>

                                         <b-form-group
                                        id="input-group"
                                        label="Longitude:"
                                        label-for="input-longitude"
                                        >

                                        <b-form-input
                                        id="input-longitude"
                                        type="number"
                                        placeholder="Enter Longitude"
                                        v-model="postalcode.longitude"
                                        ></b-form-input>

                                        </b-form-group>
                            </div>

                            <b-button class="mt-2" variant="primary" block @click="savePostalCode">Save</b-button>
                            <b-button class="mt-3" variant="outline-warning" block @click="hideModal('modal-add-postal')">Close Me</b-button>


                        </b-modal>


                        <b-modal ref="modal-add-street" hide-footer id="modal-add-street" title="Add New Street">
                            <div>
                                    <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>
                                      <b-form-group
                                        id="input-group"
                                        label="Postal Code:"
                                        label-for="input-postalcode"
                                        >

                                        <b-form-input
                                        id="input-postalcode"
                                        placeholder="Enter Postal Code"
                                        v-model="street.postal_code"
                                        type="number"
                                        ></b-form-input>

                                        </b-form-group>

                                        <b-form-group
                                        id="input-group"
                                        label="Route:"
                                        label-for="input-route"
                                        >

                                        <b-form-input
                                        id="input-route"
                                        type="text"
                                        placeholder="Enter Route"
                                        v-model="street.route"
                                        ></b-form-input>

                                        </b-form-group>


                                         <b-form-group
                                        id="input-group"
                                        label="Latitude:"
                                        label-for="input-latitude"
                                        >

                                        <b-form-input
                                        id="input-latitude"
                                        type="number"
                                        placeholder="Enter Latitude"
                                        v-model="street.latitude"
                                        ></b-form-input>

                                        </b-form-group>

                                         <b-form-group
                                        id="input-group"
                                        label="Longitude:"
                                        label-for="input-longitude"
                                        >

                                        <b-form-input
                                        id="input-longitude"
                                        type="number"
                                        placeholder="Enter Longitude"
                                        v-model="street.longitude"
                                        ></b-form-input>

                                        </b-form-group>
                            </div>

                            <b-button class="mt-2" variant="primary" block @click="saveStreet">Save</b-button>
                            <b-button class="mt-3" variant="outline-warning" block @click="hideModal('modal-add-street')">Close Me</b-button>


                        </b-modal>

                        <table id="example" class="mt-3 table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Postal Code</th>
                                        <th>Route</th>
                                        <th>Country</th>
                                        <th>Locality</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.dataTables_filter{
    text-align: right !important;
}
.paging_simple_numbers{
    float: right !important;
}
</style>

<script>
    export default {
            data() {
      return {
        postalcode: {
          id: '',
          country: '',
          locality: '',
          latitude: '',
          longitude: ''
        },
        street:{
        postal_code: '',
        route: '',
          latitude: '',
          longitude: ''
        },
        validationErrors: null
        }
        },
        mounted() {
            this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
                this.validationErrors = null;
            })

            window.streettbl =  $("#example").DataTable({
                processing: true,
                serverSide: true,
                ajax: "/api/street/datatable",
                columns: [
                    {data: 'postal_code',orderable: false, searchable: true,"className": "text-center"},
                    {data: 'route',orderable: false, searchable: true,"className": "text-center"},
                    {data: 'country',orderable: false, searchable: false,"className": "text-center"},
                    {data: 'locality',orderable: false, searchable: false,"className": "text-center"},
                    {data: 'latitude',orderable: false, searchable: false,"className": "text-center"},
                    {data: 'longitude',orderable: false, searchable: false,"className": "text-center"},
                ]
            });
        },

        methods: {
        savePostalCode() {
            this.validationErrors = null;
            axios.post("api/postal_code/store", this.postalcode)
            .then((response) => {
                console.log(this.$refs);
                this.hideModal("modal-add-postal");
            })
            .catch((error) => {
                 if (error.response && error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                }
            });
        },
        saveStreet() {
            this.validationErrors = null;
            axios.post("api/street/store", this.street)
            .then((response) => {
                console.log(this.$refs);
                this.hideModal("modal-add-street");
                window.streettbl.draw();
            })
            .catch((error) => {
                 if (error.response && error.response.status == 422){
                    this.validationErrors = error.response.data.errors;
                }
            });
        },
        hideModal(modal) {
            this.$refs[modal].hide()
        },
    }
    }
</script>
