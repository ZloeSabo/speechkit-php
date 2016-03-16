1. move options to speech content

Speechkit
- contains uploader
- contains response parser
- contains functions to upload
- catches specific uploader/parser exceptions
- catches general exceptions ???

Speech
- contains speech content
- streams given data or reads file in chunks
- contains options (language, topic, content-type)

Uploader
- uploads given Speech instance to configured url using given client
- throws exception in case of uploading error
- returns instance of UploadResponse

Client
- wraps http client library

ResponseParser
- parses given UploadResponse
- returns instance of UploadResult

UploadResponse
- contains response content
- contains response headers
- contains response code