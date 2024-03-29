export default class StorageService {
  static get<T>(key: string): T | null {
    const content = localStorage.getItem(key)

    if (!content) return null

    return JSON.parse(content)
  }

  static set(key: string, content: unknown): void {
    localStorage.setItem(key, JSON.stringify(content))
  }

  static remove(key: string): void {
    localStorage.removeItem(key)
  }
}
