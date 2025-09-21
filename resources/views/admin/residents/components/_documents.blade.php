<div class="card mb-3">
    <div class="card-header">
        <h4 class="card-title">Dokumen</h4>
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
            Upload
        </button>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Nama File</th>
                    <th>Ukuran</th>
                    <th>Wajib?</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($resident->documents->isEmpty())
                    <tr><td colspan="5" class="text-center text-muted">Belum ada dokumen</td></tr>
                @else
                    @foreach($resident->documents as $doc)
                        <tr>
                            <td>{{ $doc->document_type }}</td>
                            {{-- <td>
                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-blue">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                        <line x1="9" y1="9" x2="10" y2="9" />
                                        <line x1="9" y1="13" x2="15" y2="13" />
                                        <line x1="9" y1="17" x2="15" y2="17" />
                                    </svg>
                                    {{ $doc->file_name }}
                                </a>
                            </td> --}}
                            {{-- <td>{{ number_format(filesize(storage_path('app/' . $doc->file_path)) / 1024, 2) }} KB</td> --}}
                            <td>
                                <span class="badge bg-{{ $doc->is_required ? 'red' : 'gray' }}-lt">
                                    {{ $doc->is_required ? 'Wajib' : 'Opsional' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info">Lihat</a>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDeleteDocument({{ $doc->id }})">
                                    Hapus
                                </button>
                                <form id="delete-document-{{ $doc->id }}" 
      action="{{ route('admin.master.residents.documents.destroy', $doc) }}" 
      method="POST" 
      style="display: none;">
    @csrf
    @method('DELETE')
</form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Upload Dokumen -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.master.residents.documents.store', $resident) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="resident_id" value="{{ $resident->id }}">
                <input type="hidden" name="unit_id" value="{{ $resident->units->first()?->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDocumentModalLabel">Upload Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Jenis Dokumen</label>
                        <input type="text" name="document_type" class="form-control" placeholder="Contoh: KTP, KK, NPWP" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File (PDF/IMG)</label>
                        <input type="file" name="file" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-check form-switch">
                            <input type="checkbox" name="is_required" class="form-check-input" value="1">
                            <span class="form-check-label">Dokumen ini wajib?</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDeleteDocument(id) {
    if (confirm('Yakin ingin menghapus dokumen ini? File akan dihapus permanen.')) {
        document.getElementById('delete-document-' + id).submit();
    }
}
</script>
@endpush