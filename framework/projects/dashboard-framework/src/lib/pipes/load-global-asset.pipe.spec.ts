import { LoadGlobalAssetPipe } from './load-global-asset.pipe';

describe('LoadGlobalAssetPipe', () => {
  it('create an instance', () => {
    const pipe = new LoadGlobalAssetPipe(undefined, undefined);
    expect(pipe).toBeTruthy();
  });
});
