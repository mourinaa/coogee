import axios from "@axios";
import { defineStore } from 'pinia';
import type { EventParams } from "./types";

export const useEventStore = defineStore('DefineEventStore', {
  actions: {
    // 👉 Fetch all events
    fetchEvents(params: EventParams) {
      // /dashboard/analytics/projects'
      return axios.get('/dashboard/events', { params })
    },
    // 👉 fetch selected event
    fetchEvent(id: number) {
      return axios.get(`/dashboard/events/${id}`)
    },
    // 👉 Fetch ......
    // fetchUser() {
    //   return axios.get('127.0.0.1:5432');
    // }

  }
})
