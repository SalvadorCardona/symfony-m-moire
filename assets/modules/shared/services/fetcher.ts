import { components, paths } from '@/schema/app-api-schema'
import { Fetcher } from 'openapi-typescript-fetch'
import StorageService from '@/modules/shared/services/StorageService'
import { Token } from '@/modules/user/services/UserService'

export interface Hydra<T> {
  'hydra:member': T[]
  'hydra:totalItems'?: number
  'hydra:view'?: {
    '@id'?: string
    '@type'?: string
    'hydra:first'?: string
    'hydra:last'?: string
    'hydra:previous'?: string
    'hydra:next'?: string
  }
  'hydra:search'?: {
    '@type'?: string
    'hydra:template'?: string
    'hydra:variableRepresentation'?: string
    'hydra:mapping'?: {
      '@type'?: string
      variable?: string
      property?: string | null
      required?: boolean
    }[]
  }
}

export type ApiSchemas = components['schemas']

// const headers = {
//   accept: 'application/ld+json',
//   'Content-Type': 'application/ld+json',
// }

const headers = {
  accept: 'application/json',
  'Content-Type': 'application/json',
}

// declare fetcher for paths
const fetcher = Fetcher.for<paths>()
const token = StorageService.get<Token>('user')

if (token) {
  // eslint-disable-next-line @typescript-eslint/ban-ts-comment
  // @ts-ignore
  headers.Authorization = 'Bearer ' + token.token
}

// global configuration
fetcher.configure({
  baseUrl: 'http://localhost:8888',
  init: {
    headers: headers,
  },
  use: [], // middlewares
})

export default fetcher
