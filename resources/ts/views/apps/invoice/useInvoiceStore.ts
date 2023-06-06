import axios from '@axios'
import { defineStore } from 'pinia'
import type { InvoiceParams } from './types'

export const useInvoiceStore = defineStore('InvoiceStore', {
  actions: {
    // 👉 Fetch all Invoices
    fetchInvoices(params: InvoiceParams) {
      return axios.get('apps/invoices', { params })
    },

    // 👉 Fetch single invoice
    fetchInvoice(id: number) {
      return axios.get(`/apps/invoices/${id}`)
    },

    // 👉 Fetch Clients
    fetchClients() {
      return axios.get('/apps/invoice/clients')
    },
  },
})
