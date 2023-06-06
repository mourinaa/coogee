import mock from '@/@fake-db/mock'
import type { Event } from '@/@fake-db/types'
import { paginateArray } from '../utlis'
const now = new Date()
const currentMonth = now.toLocaleString('default', { month: '2-digit' })


const database: Event[] = [
  {
    id: 111,
    title: 'Event 1',
    url: 'https://www.google.com',
    eventTime: `${now.getFullYear()}-${currentMonth}-1`,
    eventDate: `${now.getFullYear()}-${currentMonth}-23`,
  },
  {
    id: 222,
    title: 'Event 2',
    url: 'https://www.google.com',
    eventTime: `${now.getFullYear()}-${currentMonth}-2`,
    eventDate: `${now.getFullYear()}-${currentMonth}-23`,
  },
]

// 👉 All Events
mock.onGet('/dashboard/events').reply(config => {
  const { q = '', status = null, perPage = 0, currentPage = 1, startDate = '', endDate = '' } = config.params ?? {}
  const queryLowered = q.toLowerCase()
  console.log(`MOCK GET DASHBOARD EVENT: ${q}`);

  let filtered = database.filter(
    data => (
      data.id.toString().includes(queryLowered)

    ),
  )

  if (startDate && endDate) {
    filtered = filtered.filter(obj => {
      const start = new Date(startDate).getTime()
      const end = new Date(endDate).getTime()
      const issuedDate = new Date(obj.eventDate).getTime()

      return issuedDate >= start && issuedDate <= end
    })
  }

  const totalPage = Math.ceil(filtered.length / perPage) ? Math.ceil(filtered.length / perPage) : 1
  const totalEvents = filtered.length;
  console.log(`RETURN DASHBOARD EVENTS: ${totalEvents}`);
  return [200, {
    events: paginateArray(filtered, perPage, currentPage), totalPage, totalEvents
  }]

})


// 👉 Selected Event
mock.onGet(/\/dashboard\/events\/\d+/).reply(config => {

  const eventId = config.url?.substring(config.url.lastIndexOf('/') + 1)
  const id = Number(eventId)
  console.log('SELECTED EVENT ID', id);
  const event = database.find(e => e.id === id)
  // console.log('SELECTED EVENT', event, database.map(e => e.id));
  if (!event) {
    return [404, { message: 'Not found event id' }]
  }
  const responseData = {
    title: 'TITLE',
    time: '100',
    date: '200',
    url: 'https://www.google.com'
  }
  return [200, responseData];
})
