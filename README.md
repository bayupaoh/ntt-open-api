# ntt-open-api
API related with Nusa Tenggara Timur

# List of API

Base Url : *https://open-api-ntt.herokuapp.com/*
|No |Path   |  Method  |  Description | 
|---|---|---|---|
|1   |`api/siranap/ntt/kabupaten`   |GET   |Get list of regency in Nusa Tenggara Timur (Source: https://yankes.kemkes.go.id/app/siranap/) |
|2   |`api/siranap/ntt/tempat-tidur/covid`   |GET   |Get list of hospital bed availability for covid treatment from each hospital in Nusa Tenggara Timur (Source: https://yankes.kemkes.go.id/app/siranap/)    |
|3   |`api/siranap/ntt/tempat-tidur/covid/{id}`   |GET   |Get detail information related hospital bed availability for covid treatment (Source: https://yankes.kemkes.go.id/app/siranap/)    |
|4   |`api/siranap/ntt/tempat-tidur/non-covid`  |GET   | Get list of hospital bed availability for non covid treatment from each hospital in Nusa Tenggara Timur (Source: https://yankes.kemkes.go.id/app/siranap/   |
|5   |`api/siranap/ntt/tempat-tidur/non-covid/{id}`   |GET   |Get detail information related hospital bed availability for non covid treatment (Source: https://yankes.kemkes.go.id/app/siranap/)    |
|6   |`api/hospital`  |GET   |Get list hospital information in NTT (Source: https://id.wikipedia.org/wiki/Daftar_rumah_sakit_di_Nusa_Tenggara_Timur)    |
|7   |`api/hospital/sdm`   |GET   |Get information related hospital human resources in NTT (Source: http://bppsdmk.kemkes.go.id/info_sdmk/info/distribusi_sdmk_rs_per_prov)    |