// import type { Event } from '@/@fake-db/types'


// 👉 EVENT DATA
export interface EventData {
  title: string
  time: string
  date: string
  url: string
}


// 👉 EVENT PARAMS
export interface EventParams {
  q?: string,
  status?: string,
  perPage: number,
  currentPage: number,
  startDate?: string,
  endDate?: string,
}
