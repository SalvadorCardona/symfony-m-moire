import fetcher, { ApiSchemas } from '@/modules/shared/services/fetcher'
import { ApiResponse } from 'openapi-typescript-fetch'
import StorageService from '@/modules/shared/services/StorageService'
import jwtDecode, { JwtPayload } from 'jwt-decode'

export type User = ApiSchemas['User']
export type Token = ApiSchemas['Token']
export interface LoginRequest {
  email: string
  password: string
}

export const userKey = 'user'

export default class UserService {
  public token: Token | null = StorageService.get<Token>(userKey)

  public get user(): JwtPayload | null {
    return this.token ? jwtDecode<JwtPayload>(this.token.token as string) : null
  }

  public isLogged(): boolean {
    if (!this.token) return false

    if (!this.user?.exp) return false

    return Date.now() <= this.user?.exp * 1000
  }

  public connection(loginRequest: LoginRequest): Promise<ApiResponse<Token>> {
    return fetcher
      .path('/api/authentication/token')
      .method('post')
      .create()(loginRequest)
      .then((response) => {
        this.token = response.data
        StorageService.set(userKey, this.token)
        return response
      })
  }

  public logout(): void {
    StorageService.remove(userKey)
  }
}
