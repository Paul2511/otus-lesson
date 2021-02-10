// axios
import axios from 'axios'
import qs from 'qs';

const baseURL = ''

export default axios.create({
  baseURL,
    paramsSerializer: (params) => {
        return qs.stringify(params, {arrayFormat: 'repeat'});
    },
  // You can add your headers here
})
