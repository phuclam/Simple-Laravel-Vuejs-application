import axios from 'axios';

export default {
    list() {
        let uri = API_URL + '/bookings';
        return axios.get(uri).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    },
    detail(id) {
        let uri = API_URL + '/bookings/' + id;
        return axios.get(uri).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    },
    create(dataObj) {
        let uri = API_URL + '/bookings/';
        return axios.post(uri, dataObj).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    },
    update(id, dataObj) {
        let uri = API_URL + '/bookings/' + id;
        return axios.put(uri, dataObj).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    },
    delete(id) {
        let uri = API_URL + '/bookings/' + id;
        return axios.delete(uri).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    }
}