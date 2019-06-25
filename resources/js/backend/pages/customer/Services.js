import axios from 'axios';

export default {
    list() {
        let uri = API_URL + '/users';
        return axios.get(uri).then(response => {
            if (typeof response.data.data !== 'undefined') {
                return response.data.data;
            }
        });
    },
}