import axios from 'axios'

const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  // baseURL: 'https://some-domain.com/api/',
  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}

  baseURL: 'http://127.0.0.1:8000/',
})

// Vue.prototype.$http = axiosIns

export default axiosIns
