const axios = require('axios')

axios.create({
    headers: {
        'X-Requested-With': XMLHttpRequest
    }
})

module.exports = axios