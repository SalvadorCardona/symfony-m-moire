import fetcher, { ApiSchemas } from '@/modules/shared/services/fetcher'
import { ApiResponse } from 'openapi-typescript-fetch'

export type User = ApiSchemas['User']
export type Token = ApiSchemas['Token']
export interface LoginRequest {
  email: string
  password: string
}

export default class UserService {
  public user = []
  public token: Token | null = null

  public loadUser(): void {}

  public connection(loginRequest: LoginRequest): Promise<ApiResponse<Token>> {
    return fetcher
      .path('/api/authentication/token')
      .method('post')
      .create()(loginRequest)
      .then((response) => {
        this.token = response.data
        return response
      })
  }
}
