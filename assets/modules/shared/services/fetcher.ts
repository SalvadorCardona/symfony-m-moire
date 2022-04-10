import { paths, components} from '@/schema/app-api-schema'
import { Fetcher } from 'openapi-typescript-fetch'

export type ApiSchemas = components['schemas']

// declare fetcher for paths
const fetcher = Fetcher.for<paths>()

// global configuration
fetcher.configure({
  baseUrl: 'http://localhost:8080',
  init: {
    headers: {
    },
  },
  use: [] // middlewares
})

export default fetcher
