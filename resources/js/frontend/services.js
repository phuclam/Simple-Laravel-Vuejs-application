import axios from 'axios';

export default {
    register(dataObj) {
        let uri = API_URL + '/register';
        return axios.post(uri, dataObj).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    }
}