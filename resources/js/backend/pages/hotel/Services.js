import axios from 'axios';

export default {
    detail() {
        let uri = API_URL + '/hotel';
        return axios.get(uri).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    },
    update(dataObj) {
        let uri = API_URL + '/hotel';
        return axios.put(uri, dataObj).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    },
}